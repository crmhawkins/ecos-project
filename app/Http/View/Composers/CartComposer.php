<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Carrito\ShoppingCartItem;

class CartComposer
{
    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $cartCount = 0;
        
        if (Auth::guard('alumno')->check()) {
            $cartCount = ShoppingCartItem::where('alumno_id', Auth::guard('alumno')->id())
                                        ->sum('cantidad');
        }
        
        $view->with('cartCount', $cartCount);
    }
}
