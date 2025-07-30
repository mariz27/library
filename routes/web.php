<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\MemberPortalController;
use App\Http\Controllers\MemberAuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BarcodeController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\BarcodeGeneratorController;
use App\Http\Controllers\LibrarianController;

// Test route
Route::get('/test', function () {
    return view('test');
});

// Redirect root to login
Route::get('/', function () {
    return redirect()->route('login');
});

// Authentication Routes
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login')->name('login.submit');
    Route::post('/logout', 'logout')->name('logout');
});

// Protected Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Books Routes
    Route::resource('books', BookController::class)->except(['show']);
    
    // Members Routes
    Route::resource('members', MemberController::class)->except(['show']);
    
    // Admin Users Routes
    Route::resource('users', UserController::class)->except(['show']);
    
    // Borrowings Routes
    Route::resource('borrowings', BorrowingController::class)->except(['show', 'edit', 'update']);
    Route::get('/borrowings/overdue', [BorrowingController::class, 'overdue'])->name('borrowings.overdue');
    Route::get('/borrowings/history', [BorrowingController::class, 'history'])->name('borrowings.history');
    Route::patch('/borrowings/{borrowing}/return', [BorrowingController::class, 'return'])->name('borrowings.return');
    
    // Barcode Scanner Routes
    Route::get('/barcode/scan', [BarcodeController::class, 'scanIndex'])->name('barcode.scan');
    Route::get('/barcode/process', [BarcodeController::class, 'processBarcode'])->name('barcode.process');
    Route::post('/barcode/checkout', [BarcodeController::class, 'quickCheckout'])->name('barcode.checkout');
    Route::post('/barcode/return', [BarcodeController::class, 'quickReturn'])->name('barcode.return');
    
    // Barcode Generator Routes
    Route::get('/barcode/generate', [BarcodeGeneratorController::class, 'index'])->name('barcode.index');
    Route::post('/barcode/generate/books', [BarcodeGeneratorController::class, 'generateBookBarcodes'])->name('barcode.generate.books');
    Route::post('/barcode/generate/members', [BarcodeGeneratorController::class, 'generateMemberBarcodes'])->name('barcode.generate.members');
    Route::get('/barcode/book/{id}', [BarcodeGeneratorController::class, 'showBookBarcode'])->name('barcode.show.book');
    Route::get('/barcode/member/{id}', [BarcodeGeneratorController::class, 'showMemberBarcode'])->name('barcode.show.member');
    Route::get('/barcode/api/book/{id}', [BarcodeGeneratorController::class, 'generateSingleBookBarcode'])->name('barcode.api.book');
    Route::get('/barcode/api/member/{id}', [BarcodeGeneratorController::class, 'generateSingleMemberBarcode'])->name('barcode.api.member');
    Route::get('/barcode/download/book/{id}', [BarcodeGeneratorController::class, 'downloadBookBarcode'])->name('barcode.download.book');
    Route::get('/barcode/download/member/{id}', [BarcodeGeneratorController::class, 'downloadMemberBarcode'])->name('barcode.download.member');
    
    // Reservation Routes
    Route::resource('reservations', ReservationController::class)->except(['show', 'edit', 'update']);
    Route::patch('/reservations/{reservation}/cancel', [ReservationController::class, 'cancel'])->name('reservations.cancel');
    Route::patch('/reservations/{reservation}/fulfill', [ReservationController::class, 'fulfill'])->name('reservations.fulfill');
    Route::get('/reservations/history', [ReservationController::class, 'history'])->name('reservations.history');
    Route::get('/reservations/check-availability', [ReservationController::class, 'checkAvailability'])->name('reservations.check-availability');
    
    // Reports Routes
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::post('/reports/generate', [ReportController::class, 'generate'])->name('reports.generate');
    Route::get('/reports/{filename}', [ReportController::class, 'show'])->name('reports.show');
    Route::get('/reports/{filename}/download', [ReportController::class, 'download'])->name('reports.download');
    Route::delete('/reports/{filename}', [ReportController::class, 'delete'])->name('reports.delete');
    Route::get('/reports-dashboard', [ReportController::class, 'dashboard'])->name('reports.dashboard');
});

// Member Authentication Routes
Route::get('/member/login', [MemberAuthController::class, 'showLogin'])->name('member.login');
Route::post('/member/login', [MemberAuthController::class, 'login'])->name('member.login.submit');
Route::post('/member/logout', [MemberAuthController::class, 'logout'])->name('member.logout');

// Member Portal Routes (Auth Required)
Route::middleware('member.auth')->group(function () {
    // Routes for all members
    Route::get('/member/dashboard', [MemberPortalController::class, 'dashboard'])->name('member.dashboard');
    Route::get('/member/books', [MemberPortalController::class, 'books'])->name('member.books');
    Route::post('/member/borrow', [MemberPortalController::class, 'borrowBook'])->name('member.borrow');
    Route::get('/member/profile', [MemberPortalController::class, 'profile'])->name('member.profile');
    Route::put('/member/profile', [MemberPortalController::class, 'updateProfile'])->name('member.profile.update');
    Route::get('/member/reservations', [MemberPortalController::class, 'reservations'])->name('member.reservations');
    Route::post('/member/reserve', [MemberPortalController::class, 'reserveBook'])->name('member.reserve');
    Route::patch('/member/reservations/{reservation}/cancel', [MemberPortalController::class, 'cancelReservation'])->name('member.reservations.cancel');
    
    // Routes for librarians only
    Route::middleware('member.role:librarian')->group(function () {
        // Librarian-specific routes that stay within the member portal
        Route::get('/member/manage-books', [LibrarianController::class, 'manageBooks'])->name('member.manage-books');
        Route::get('/member/manage-borrowings', [LibrarianController::class, 'manageBorrowings'])->name('member.manage-borrowings');
        Route::get('/member/manage-reservations', [LibrarianController::class, 'manageReservations'])->name('member.manage-reservations');
        
        // Book management routes
        Route::get('/member/books/create', [LibrarianController::class, 'createBook'])->name('member.librarian.books.create');
        Route::post('/member/books', [LibrarianController::class, 'storeBook'])->name('member.librarian.books.store');
        Route::get('/member/books/{book}/edit', [BookController::class, 'edit'])->name('member.librarian.books.edit');
        Route::put('/member/books/{book}', [BookController::class, 'update'])->name('member.librarian.books.update');
        Route::delete('/member/books/{book}', [BookController::class, 'destroy'])->name('member.librarian.books.destroy');
        
        // Borrowing management routes
        Route::get('/member/borrowings/create', [LibrarianController::class, 'createBorrowing'])->name('member.librarian.borrowings.create');
        Route::post('/member/borrowings', [LibrarianController::class, 'storeBorrowing'])->name('member.librarian.borrowings.store');
        Route::patch('/member/borrowings/{borrowing}/return', [LibrarianController::class, 'returnBook'])->name('member.librarian.borrowings.return');
        Route::delete('/member/borrowings/{borrowing}', [LibrarianController::class, 'destroyBorrowing'])->name('member.librarian.borrowings.destroy');
        Route::get('/member/borrowings/overdue', [LibrarianController::class, 'overdueBorrowings'])->name('member.librarian.borrowings.overdue');
        Route::get('/member/borrowings/history', [LibrarianController::class, 'borrowingHistory'])->name('member.librarian.borrowings.history');
        
        // Reservation management routes
        Route::patch('/member/reservations/{reservation}/fulfill', [LibrarianController::class, 'fulfillReservation'])->name('member.librarian.reservations.fulfill');
        Route::patch('/member/reservations/{reservation}/cancel', [LibrarianController::class, 'cancelReservation'])->name('member.librarian.reservations.cancel');
    });
});