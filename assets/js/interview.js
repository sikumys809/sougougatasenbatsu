/**
 * interview.js — 合格者対談 個別ページ
 * 1. サイトヘッダーの実高さを --iv-top に流し込む（記事ナビの吸着位置）
 * 2. 読了プログレスバー
 * 3. LINE追従バーの出し入れ（特典CTAが見えたら引っ込める）
 * 4. タブの現在地表示とスムーズスクロール
 */
(function () {
  'use strict';

  var page = document.querySelector('.iv-page');
  if (!page) { return; }

  var header   = document.querySelector('.keikyo-interview-header'),
      navbar   = document.getElementById('iv-navbar'),
      progress = document.getElementById('iv-progress'),
      dock     = document.getElementById('iv-dock'),
      gift     = document.getElementById('iv-gift'),
      tabs     = Array.prototype.slice.call(document.querySelectorAll('[data-iv-tab]')),
      pipFrame = null,
      pipOff   = false,
      targets  = tabs.map(function (t) { return document.getElementById(t.getAttribute('data-iv-tab')); });

  function syncHeaderOffset() {
    var h = 0;
    if (header) {
      var pos = window.getComputedStyle(header).position;
      if (pos === 'sticky' || pos === 'fixed') {
        h = Math.round(header.getBoundingClientRect().height);
      }
    }
    page.style.setProperty('--iv-top', h + 'px');
  }

  // サムネイルをタップして初めて YouTube を読み込む（lite-embed）
  Array.prototype.slice.call(document.querySelectorAll('[data-iv-yt]')).forEach(function (frame) {
    var btn = frame.querySelector('.iv-movie__thumb');
    if (!btn) { return; }
    btn.addEventListener('click', function () {
      var id = frame.getAttribute('data-iv-yt'),
          f  = document.createElement('iframe');
      f.src = 'https://www.youtube.com/embed/' + id + '?autoplay=1&rel=0&playsinline=1';
      f.title = '動画';
      f.setAttribute('allow', 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share');
      f.setAttribute('allowfullscreen', '');
      frame.innerHTML = '';
      frame.appendChild(f);

      if (frame.getAttribute('data-iv-pip')) {
        pipFrame = frame;
        pipOff   = false;
        var close = document.createElement('button');
        close.type = 'button';
        close.className = 'iv-movie__pipclose';
        close.setAttribute('aria-label', 'ミニプレーヤーを閉じる');
        close.textContent = '\u2715';
        close.addEventListener('click', function (e) {
          e.stopPropagation();
          pipOff = true;
          frame.classList.remove('is-pip');
          tick();
        });
        frame.appendChild(close);
      }
      tick();
    });
  });

  function stickyBottom() {
    return navbar ? Math.max(0, navbar.getBoundingClientRect().bottom) : 0;
  }

  function tick() {
    var doc = document.documentElement,
        max = doc.scrollHeight - window.innerHeight,
        y   = window.scrollY || window.pageYOffset,
        p   = max > 0 ? Math.min(100, Math.max(0, (y / max) * 100)) : 0;

    if (progress) { progress.style.width = p.toFixed(1) + '%'; }

    var pipOn = false;
    if (pipFrame && !pipOff) {
      pipOn = pipFrame.parentNode.getBoundingClientRect().bottom < 0;
      pipFrame.classList.toggle('is-pip', pipOn);
    }

    if (dock && gift) {
      dock.classList.toggle('is-on', p > 6 && gift.getBoundingClientRect().top > window.innerHeight * 0.75);
    }

    // ミニプレーヤーとCTAバーを積む。互いの高さを変数で渡して重なりを避ける。
    // 高さ＋隙間を渡す。CTAバーはこの分だけ持ち上がる。
    page.style.setProperty('--iv-piph', pipOn ? (Math.round(pipFrame.getBoundingClientRect().height) + 10) + 'px' : '0px');
    page.style.setProperty(
      '--iv-dockh',
      (dock && dock.classList.contains('is-on')) ? Math.round(dock.getBoundingClientRect().height) + 'px' : '0px'
    );

    if (tabs.length) {
      var active = 0,
          line   = stickyBottom() + 30;
      for (var i = 0; i < targets.length; i++) {
        if (targets[i] && targets[i].getBoundingClientRect().top <= line) { active = i; }
      }
      for (var j = 0; j < tabs.length; j++) {
        tabs[j].classList.toggle('is-on', j === active);
      }
    }
  }

  document.addEventListener('click', function (e) {
    var t = e.target,
        a = (t && t.closest) ? t.closest('.iv-page a[href^="#"]') : null;
    if (!a) { return; }
    var id = (a.getAttribute('href') || '').slice(1);
    if (!id) { return; }
    var el = document.getElementById(id);
    if (!el) { return; }
    e.preventDefault();
    var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    el.scrollIntoView({ behavior: reduce ? 'auto' : 'smooth', block: 'start' });
    if (window.history && window.history.replaceState) {
      window.history.replaceState(null, '', '#' + id);
    }
  });

  window.addEventListener('scroll', tick, { passive: true });
  window.addEventListener('resize', function () { syncHeaderOffset(); tick(); });
  window.addEventListener('load', function () { syncHeaderOffset(); tick(); });

  syncHeaderOffset();
  tick();
})();
