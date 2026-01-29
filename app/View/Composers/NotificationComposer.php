<?php

namespace App\View\Composers;

use Illuminate\View\View;
use App\Models\ContactMessage;

class NotificationComposer
{
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $unreadContactCount = ContactMessage::where('status', 'Baru')->count();
        $view->with('unreadContactCount', $unreadContactCount);
    }
}
