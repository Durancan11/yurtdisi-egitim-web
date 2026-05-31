<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserStatus
{
    /**
     * Gelen isteği işle.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Kullanıcı giriş yapmışsa ve durumu aktif değilse (kendi veritabanı sütun ismine göre 'status' veya 'is_active' kısmını düzelt)
        if (auth()->check() && auth()->user()->status === 'inactive') {
            
            // DÖNGÜYÜ KIRAN SİHİRLİ KOD: Önce sistemden çıkış yaptır!
            auth()->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect('/login')->with('error', 'Hesabınız askıya alınmıştır.');
        }

        return $next($request);
    }
}