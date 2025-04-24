<?php

namespace App\Modules\Moodle\Resources\views\components;

?>

<div class="notification {{ $type ?? 'info' }} {{ $dismissible ? 'is-dismissible' : '' }}">
    @if($dismissible)
    <button type="button" class="notification-dismiss" aria-label="Cerrar">&times;</button>
    @endif
    
    <div class="notification-icon">
        @if($type == 'success')
            <i class="fas fa-check-circle"></i>
        @elseif($type == 'error')
            <i class="fas fa-exclamation-circle"></i>
        @elseif($type == 'warning')
            <i class="fas fa-exclamation-triangle"></i>
        @else
            <i class="fas fa-info-circle"></i>
        @endif
    </div>
    
    <div class="notification-content">
        @if(!empty($title))
        <div class="notification-title">{{ $title }}</div>
        @endif
        
        <div class="notification-message">{{ $message }}</div>
    </div>
</div>

<style>
    .notification {
        display: flex;
        padding: 15px;
        border-radius: 4px;
        margin-bottom: 20px;
        position: relative;
        border-left: 4px solid;
    }
    
    .notification.success {
        background-color: #d4edda;
        color: #155724;
        border-color: #28a745;
    }
    
    .notification.error {
        background-color: #f8d7da;
        color: #721c24;
        border-color: #dc3545;
    }
    
    .notification.warning {
        background-color: #fff3cd;
        color: #856404;
        border-color: #ffc107;
    }
    
    .notification.info {
        background-color: #d1ecf1;
        color: #0c5460;
        border-color: #17a2b8;
    }
    
    .notification-icon {
        margin-right: 15px;
        font-size: 24px;
        display: flex;
        align-items: center;
    }
    
    .notification-content {
        flex: 1;
    }
    
    .notification-title {
        font-weight: bold;
        margin-bottom: 5px;
    }
    
    .notification-dismiss {
        position: absolute;
        top: 10px;
        right: 10px;
        background: transparent;
        border: none;
        font-size: 20px;
        cursor: pointer;
        color: inherit;
        opacity: 0.7;
    }
    
    .notification-dismiss:hover {
        opacity: 1;
    }
    
    .notification.is-dismissible {
        padding-right: 35px;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add event listeners to dismiss buttons
        const dismissButtons = document.querySelectorAll('.notification-dismiss');
        dismissButtons.forEach(button => {
            button.addEventListener('click', function() {
                const notification = this.closest('.notification');
                notification.style.display = 'none';
            });
        });
        
        // Auto-dismiss notifications after 5 seconds if they have the auto-dismiss class
        const autoDismissNotifications = document.querySelectorAll('.notification.auto-dismiss');
        autoDismissNotifications.forEach(notification => {
            setTimeout(() => {
                notification.style.opacity = '0';
                notification.style.transition = 'opacity 0.5s ease';
                setTimeout(() => {
                    notification.style.display = 'none';
                }, 500);
            }, 5000);
        });
    });
</script>
