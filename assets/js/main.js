/**
 * Keikyo Theme — Main JavaScript
 */
(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', function () {

        const toggle  = document.querySelector('.keikyo-interview-header__menu-toggle');
        const panel   = document.getElementById('keikyo-mobile-nav');
        const close   = document.querySelector('.keikyo-interview-header__mobile-close');
        const header  = document.getElementById('site-header');

        if (!toggle || !panel) return;

        // パネルを開く
        function openMenu() {
            panel.removeAttribute('hidden');
            toggle.setAttribute('aria-expanded', 'true');
            header.classList.add('is-menu-open');
            document.body.classList.add('keikyo-menu-open');
        }

        // パネルを閉じる
        function closeMenu() {
            panel.setAttribute('hidden', '');
            toggle.setAttribute('aria-expanded', 'false');
            header.classList.remove('is-menu-open');
            document.body.classList.remove('keikyo-menu-open');
        }

        toggle.addEventListener('click', function () {
            if (panel.hasAttribute('hidden')) {
                openMenu();
            } else {
                closeMenu();
            }
        });

        if (close) {
            close.addEventListener('click', closeMenu);
        }

        // オーバーレイ（パネル外）クリックで閉じる
        panel.addEventListener('click', function (e) {
            if (e.target === panel) {
                closeMenu();
            }
        });

        // ESCキーで閉じる
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') closeMenu();
        });
    });
})();
