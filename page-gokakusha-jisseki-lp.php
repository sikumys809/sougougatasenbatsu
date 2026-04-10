<?php
/**
 * Template Name: 合格者実績 LP
 * Template Post Type: page
 */

defined('ABSPATH') || exit;

$consultation_url = 'https://bit.ly/4kDgEU1';
$diagnosis_url = 'https://www.keikyo-seminar.jp/diagnosis';
$interview_archive_url = 'https://www.keikyo-seminar.jp/archives/tag/interview-with-successful-candidates';
$logo_url = 'https://www.keikyo-seminar.jp/wp-content/uploads/2026/03/LOGO.png';
$home_url = 'https://www.keikyo-seminar.jp/';
$teacher_image_url = 'https://www.keikyo-seminar.jp/wp-content/uploads/2026/03/%E5%90%8D%E7%A7%B0%E6%9C%AA%E8%A8%AD%E5%AE%9A%E3%81%AE%E3%83%87%E3%82%B6%E3%82%A4%E3%83%B3-12.jpg';

$university_groups = [
    [
        'title' => '早慶上理',
        'accent' => 'red',
        'items' => [
            ['name' => '慶應義塾大学', 'dept' => '環境情報学部', 'ratio' => '倍率4.5'],
            ['name' => '慶應義塾大学', 'dept' => '総合政策学部', 'ratio' => '倍率5.9'],
            ['name' => '早稲田大学', 'dept' => '人間科学部', 'ratio' => '倍率5.7'],
            ['name' => '上智大学', 'dept' => '総合人間科学部', 'ratio' => '倍率3.3'],
            ['name' => '上智大学', 'dept' => '総合グローバル学部', 'ratio' => '倍率2.5'],
        ],
    ],
    [
        'title' => '難関国公立大学',
        'accent' => 'navy',
        'items' => [
            ['name' => '横浜国立大学', 'dept' => '経営学部', 'ratio' => '倍率3.0'],
            ['name' => '東北大学', 'dept' => '法学部', 'ratio' => '倍率3.0'],
            ['name' => '九州大学', 'dept' => '共創学部 総合', 'ratio' => '倍率3.7〜5.5'],
            ['name' => '鳥取環境大学', 'dept' => '環境学部環境学科', 'ratio' => '倍率1.3〜2.7'],
        ],
    ],
    [
        'title' => 'MARCH',
        'accent' => 'red',
        'items' => [
            ['name' => '明治大学', 'dept' => '総合数理学部', 'ratio' => '倍率2.5〜5.7'],
            ['name' => '中央大学', 'dept' => '法学部', 'ratio' => '倍率4.2'],
            ['name' => '中央大学', 'dept' => '文学部', 'ratio' => '倍率3.0〜5.2'],
            ['name' => '立教大学', 'dept' => 'コミュニティ福祉学部', 'ratio' => '倍率2.8〜5.1'],
            ['name' => '立教大学', 'dept' => '経営学部', 'ratio' => '倍率1.0〜15.4'],
            ['name' => '立教大学', 'dept' => '社会学部', 'ratio' => '倍率1.7〜15.5'],
            ['name' => '青山学院大学', 'dept' => 'コミュニティ人間科学部', 'ratio' => '倍率5.3'],
        ],
    ],
    [
        'title' => '四工',
        'accent' => 'navy',
        'items' => [
            ['name' => '千葉工業大学', 'dept' => '情報変革科学部 認知情報科学科', 'ratio' => ''],
            ['name' => '東京都市大学', 'dept' => '情報工学部 知能情報工学科', 'ratio' => ''],
        ],
    ],
    [
        'title' => '五美大・四芸大',
        'accent' => 'red',
        'items' => [
            ['name' => '多摩美術大学', 'dept' => '芸術学科', 'ratio' => '倍率2.0'],
            ['name' => '日本大学', 'dept' => '芸術学部 音楽学科 情報音楽コース', 'ratio' => '倍率4.4〜9.5'],
            ['name' => '日本大学', 'dept' => '芸術学部 映画学科', 'ratio' => '倍率2.6〜4.0'],
            ['name' => '大阪芸術大学', 'dept' => '芸術学部 放送学科', 'ratio' => ''],
            ['name' => '大阪芸術大学', 'dept' => '芸術学部 芸術計画学科', 'ratio' => ''],
        ],
    ],
    [
        'title' => '関関同立',
        'accent' => 'navy',
        'items' => [
            ['name' => '同志社大学', 'dept' => '法学部', 'ratio' => '倍率1.6'],
            ['name' => '関西大学', 'dept' => '政策創造学部', 'ratio' => '倍率4.1'],
            ['name' => '関西大学', 'dept' => '法学部', 'ratio' => '倍率2.6'],
            ['name' => '関西学院大学', 'dept' => '人間福祉学部', 'ratio' => '倍率2.6'],
        ],
    ],
    [
        'title' => '日東駒専',
        'accent' => 'red',
        'items' => [
            ['name' => '日本大学', 'dept' => '商学部', 'ratio' => '倍率2.8'],
            ['name' => '専修大学', 'dept' => '経営学部', 'ratio' => '倍率1.5〜1.7'],
        ],
    ],
    [
        'title' => 'その他',
        'accent' => 'navy',
        'items' => [
            ['name' => '國學院大学', 'dept' => '観光まちづくり学部', 'ratio' => ''],
            ['name' => '成城大学', 'dept' => '社会イノベーション学部', 'ratio' => ''],
            ['name' => '武蔵野大学', 'dept' => 'データサイエンス学部', 'ratio' => ''],
            ['name' => '立命館アジア太平洋大学', 'dept' => 'アジア太平洋学部 アジア太平洋学科', 'ratio' => ''],
            ['name' => '立命館アジア太平洋大学', 'dept' => '国際経営学部 国際経営学科', 'ratio' => ''],
            ['name' => '東京国際大学', 'dept' => '商学部 経営学科', 'ratio' => ''],
        ],
    ],
];

$interview_cards = [
    [
        'label' => 'INTERVIEW 01',
        'title' => '花咲徳栄から東洋大夜間へ | 偏差値35の陸上部員が指定校推薦を勝ち取るまで',
        'text' => '部活動と進路の両立、評定の積み上げ、推薦で選ばれるための準備に触れられる対談記事です。',
        'url' => 'https://www.keikyo-seminar.jp/archives/1251',
        'image' => 'https://www.keikyo-seminar.jp/wp-content/uploads/2026/03/1-7-3-e1774919799911.jpg',
    ],
    [
        'label' => 'INTERVIEW 02',
        'title' => '面接で失敗したのに慶應SFC合格 | 女子アスリートの「言い直し」の力',
        'text' => '総合型選抜で問われる本質や、面接での立て直し方を知ることができる人気記事です。',
        'url' => 'https://www.keikyo-seminar.jp/archives/1224',
        'image' => 'https://www.keikyo-seminar.jp/wp-content/uploads/2026/03/6-4-1.jpg',
    ],
    [
        'label' => 'INTERVIEW 03',
        'title' => '都立国際を退学してカナダへ | 中卒リスクを越えて慶應SFC合格した総合型選抜',
        'text' => '数字の裏側にある意思決定や挑戦の過程を伝える、ストーリー性の高い対談記事です。',
        'url' => 'https://www.keikyo-seminar.jp/archives/1168',
        'image' => 'https://www.keikyo-seminar.jp/wp-content/uploads/2026/03/3-8.jpg',
    ],
];
?>
<?php get_header('lp'); ?>

<style id="kg-results-standalone-style">
    :root {
      --kg-red: #d92b38;
      --kg-red-deep: #b91f2e;
      --kg-red-soft: #fff3f5;
      --kg-navy: #0f315f;
      --kg-navy-deep: #0a2447;
      --kg-navy-soft: #eef4fb;
      --kg-ink: #15253c;
      --kg-muted: #5f6f84;
      --kg-line: #dce5f0;
      --kg-bg: #f7f9fc;
      --kg-card-shadow: 0 20px 55px rgba(15, 49, 95, 0.08);
      --kg-content: 1180px;
    }

    html { margin-top: 0 !important; }

    body.kg-results-body {
      margin: 0;
      background: #ffffff;
      color: var(--kg-ink);
      font-family: -apple-system, BlinkMacSystemFont, "Hiragino Sans", "Yu Gothic", "Meiryo", sans-serif;
      line-height: 1.7;
    }

    .kg-results-shell,
    .kg-results-shell * {
      box-sizing: border-box;
    }

    .kg-results-shell {
      position: relative;
      isolation: isolate;
      background: linear-gradient(180deg, #ffffff 0%, #f7f9fc 38%, #ffffff 100%);
      color: var(--kg-ink);
    }

    .kg-results-shell a {
      color: inherit;
      text-decoration: none;
    }

    .kg-results-shell img {
      display: block;
      max-width: 100%;
      height: auto;
    }

    .kg-results-shell h1,
    .kg-results-shell h2,
    .kg-results-shell h3,
    .kg-results-shell p,
    .kg-results-shell ul,
    .kg-results-shell li {
      margin: 0;
      padding: 0;
    }

    .kg-results-shell ul { list-style: none; }

    #header_area,
    #global_menu,
    #header,
    #masthead,
    #site-header,
    #siteHeader,
    #footer,
    #footer_area,
    #colophon,
    #site-footer,
    .breadcrumb,
    .breadcrumbs,
    .topicpath,
    .dp_breadcrumb,
    .entry-header,
    .page-header,
    .post-title,
    .entry-title,
    .single-headline,
    .archive-header,
    .dp-headline,
    .wp-block-post-title {
      display: none !important;
    }

    #container,
    #content,
    #main,
    .site-content,
    .content,
    .content-area,
    .l-content,
    .page-template-page-gokakusha-jisseki-lp #content,
    .page-template-page-gokakusha-jisseki-lp #main {
      width: 100% !important;
      max-width: none !important;
      margin: 0 !important;
      padding: 0 !important;
      float: none !important;
    }

    .kg-container {
      width: min(var(--kg-content), calc(100% - 40px));
      margin: 0 auto;
    }

    .kg-standalone-header {
      position: sticky;
      top: 0;
      z-index: 50;
      backdrop-filter: blur(14px);
      background: rgba(255, 255, 255, 0.92);
      border-bottom: 1px solid rgba(15, 49, 95, 0.08);
    }

    .kg-standalone-header__inner {
      min-height: 82px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 20px;
    }

    .kg-brand {
      display: inline-flex;
      align-items: center;
      flex-shrink: 0;
    }

    .kg-brand img {
      width: auto;
      height: 44px;
      object-fit: contain;
    }

    .kg-header-nav {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .kg-btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      min-height: 56px;
      padding: 0 28px;
      border-radius: 999px;
      border: 1px solid transparent;
      font-size: 15px;
      font-weight: 800;
      line-height: 1;
      transition: transform 0.2s ease, box-shadow 0.2s ease, background-color 0.2s ease, color 0.2s ease, border-color 0.2s ease;
      white-space: nowrap;
      text-shadow: none;
    }

    .kg-btn:hover { transform: translateY(-1px); }

    .kg-btn--red {
      background: linear-gradient(180deg, #e13b46 0%, #cb2433 100%);
      color: #ffffff !important;
      box-shadow: 0 14px 28px rgba(217, 43, 56, 0.24);
    }

    .kg-btn--navy {
      background: linear-gradient(180deg, #174279 0%, #0d2f5f 100%);
      color: #ffffff !important;
      box-shadow: 0 14px 28px rgba(15, 49, 95, 0.22);
    }

    .kg-btn--outline {
      background: #ffffff;
      color: var(--kg-navy) !important;
      border-color: rgba(15, 49, 95, 0.24);
      box-shadow: 0 8px 18px rgba(15, 49, 95, 0.06);
    }

    .kg-btn--contrast {
      background: #ffffff;
      color: var(--kg-navy-deep) !important;
      border: 2px solid rgba(10, 36, 71, 0.18);
      box-shadow: 0 14px 30px rgba(10, 36, 71, 0.14);
    }

    .kg-hero {
      position: relative;
      overflow: hidden;
      padding: 56px 0 50px;
      background:
        radial-gradient(circle at 16% 20%, rgba(217, 43, 56, 0.08), transparent 24%),
        radial-gradient(circle at 88% 16%, rgba(15, 49, 95, 0.1), transparent 24%),
        linear-gradient(180deg, #ffffff 0%, #f7f9fc 100%);
    }

    .kg-hero::after {
      content: "";
      position: absolute;
      inset: auto 0 -1px 0;
      height: 62px;
      background: #ffffff;
      clip-path: ellipse(55% 100% at 50% 100%);
    }

    .kg-hero-grid {
      position: relative;
      z-index: 1;
      display: grid;
      grid-template-columns: minmax(0, 1.02fr) minmax(460px, 0.98fr);
      gap: 58px;
      align-items: center;
    }

    .kg-hero-copy {
      padding: 18px 0 20px;
    }

    .kg-kicker {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      border-radius: 999px;
      background: var(--kg-red-soft);
      color: var(--kg-red);
      padding: 10px 16px;
      font-size: 12px;
      font-weight: 800;
      letter-spacing: 0.08em;
      text-transform: uppercase;
    }

    .kg-hero-title {
      margin-top: 18px;
      color: var(--kg-navy-deep);
      font-size: clamp(42px, 6vw, 80px);
      line-height: 0.96;
      font-weight: 900;
      letter-spacing: -0.05em;
    }

    .kg-hero-title span {
      display: block;
      color: var(--kg-red);
      font-size: 0.62em;
      letter-spacing: 0.02em;
      margin-bottom: 10px;
    }

    .kg-hero-lead {
      margin-top: 24px;
      color: var(--kg-navy);
      font-size: clamp(20px, 2.6vw, 34px);
      line-height: 1.38;
      font-weight: 800;
      letter-spacing: -0.02em;
    }

    .kg-hero-sublead {
      margin-top: 18px;
      max-width: 640px;
      color: var(--kg-muted);
      font-size: 17px;
      line-height: 1.95;
    }

    .kg-hero-stats {
      display: grid;
      grid-template-columns: repeat(2, minmax(0, 1fr));
      gap: 16px;
      margin-top: 30px;
    }

    .kg-stat-card {
      position: relative;
      overflow: hidden;
      border-radius: 26px;
      border: 1px solid var(--kg-line);
      background: #ffffff;
      box-shadow: var(--kg-card-shadow);
      padding: 22px 22px 20px;
    }

    .kg-stat-card::after {
      content: "";
      position: absolute;
      right: -34px;
      top: -34px;
      width: 118px;
      height: 118px;
      border-radius: 50%;
      opacity: 0.14;
    }

    .kg-stat-card.is-red::after { background: var(--kg-red); }
    .kg-stat-card.is-navy::after { background: var(--kg-navy); }

    .kg-stat-label {
      position: relative;
      display: inline-flex;
      align-items: center;
      gap: 10px;
      font-size: 15px;
      font-weight: 800;
      color: var(--kg-ink);
    }

    .kg-dot {
      width: 12px;
      height: 12px;
      border-radius: 50%;
      display: inline-block;
    }

    .kg-dot.is-red { background: var(--kg-red); }
    .kg-dot.is-navy { background: var(--kg-navy); }

    .kg-stat-number {
      position: relative;
      margin-top: 14px;
      font-size: clamp(54px, 6vw, 88px);
      line-height: 0.9;
      font-weight: 900;
      letter-spacing: -0.06em;
    }

    .kg-stat-number small {
      font-size: 0.45em;
      letter-spacing: -0.02em;
    }

    .kg-stat-number.is-red { color: var(--kg-red); }
    .kg-stat-number.is-navy { color: var(--kg-navy); }

    .kg-stat-note {
      position: relative;
      margin-top: 8px;
      color: var(--kg-muted);
      font-size: 13px;
      font-weight: 600;
    }

    .kg-cta-row {
      display: flex;
      flex-wrap: wrap;
      gap: 14px;
      margin-top: 28px;
    }

    .kg-hero-panel {
      position: relative;
      overflow: hidden;
      min-height: 580px;
      border-radius: 34px;
      padding: 28px;
      color: #ffffff;
      background:
        radial-gradient(circle at 22% 18%, rgba(255, 255, 255, 0.14), transparent 24%),
        radial-gradient(circle at 82% 82%, rgba(217, 43, 56, 0.25), transparent 24%),
        linear-gradient(145deg, rgba(15, 49, 95, 0.98), rgba(10, 36, 71, 0.99));
      box-shadow: 0 28px 64px rgba(15, 49, 95, 0.2);
      display: flex;
      align-items: flex-end;
    }

    .kg-hero-panel::before {
      content: "";
      position: absolute;
      inset: 18px;
      border-radius: 28px;
      border: 1px solid rgba(255, 255, 255, 0.1);
      pointer-events: none;
    }

    .kg-hero-panel__layout {
      position: relative;
      z-index: 1;
      display: grid;
      grid-template-columns: minmax(0, 1.08fr) minmax(210px, 0.92fr);
      gap: 22px;
      align-items: end;
      width: 100%;
    }

    .kg-hero-panel__copy {
      display: flex;
      flex-direction: column;
      gap: 18px;
    }

    .kg-hero-badge {
      display: inline-flex;
      align-items: center;
      width: fit-content;
      padding: 9px 14px;
      border-radius: 999px;
      background: rgba(255, 255, 255, 0.12);
      border: 1px solid rgba(255, 255, 255, 0.16);
      color: rgba(255,255,255,0.92);
      font-size: 12px;
      font-weight: 800;
      letter-spacing: 0.08em;
      text-transform: uppercase;
    }

    .kg-teacher-title {
      font-size: 12px;
      font-weight: 800;
      letter-spacing: 0.12em;
      color: rgba(255,255,255,0.72);
      text-transform: uppercase;
    }

    .kg-teacher-name {
      font-size: clamp(30px, 3.4vw, 44px);
      line-height: 1.15;
      font-weight: 900;
      letter-spacing: -0.03em;
      color: #ffffff;
    }

    .kg-teacher-meta {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
    }

    .kg-teacher-meta span {
      display: inline-flex;
      align-items: center;
      min-height: 36px;
      padding: 0 14px;
      border-radius: 999px;
      background: rgba(255,255,255,0.12);
      border: 1px solid rgba(255,255,255,0.14);
      color: #ffffff;
      font-size: 13px;
      font-weight: 800;
    }

    .kg-teacher-text {
      color: rgba(255,255,255,0.84);
      font-size: 15px;
      line-height: 1.85;
      max-width: 420px;
    }

    .kg-teacher-visual {
      position: relative;
      justify-self: end;
      width: min(100%, 250px);
    }

    .kg-teacher-visual::after {
      content: "";
      position: absolute;
      inset: auto 18px -14px 18px;
      height: 26px;
      background: rgba(6, 20, 39, 0.26);
      filter: blur(14px);
      border-radius: 50%;
      z-index: 0;
    }

    .kg-teacher-visual img {
      position: relative;
      z-index: 1;
      width: 100%;
      aspect-ratio: 4 / 5;
      object-fit: cover;
      border-radius: 26px;
      border: 3px solid rgba(255,255,255,0.14);
      box-shadow: 0 22px 36px rgba(3, 14, 31, 0.28);
      background: #d9e2ef;
    }

    .kg-notice-bar {
      border-top: 1px solid rgba(15, 49, 95, 0.08);
      border-bottom: 1px solid rgba(15, 49, 95, 0.08);
      background: #f5f7fb;
      color: var(--kg-muted);
      font-size: 14px;
      font-weight: 700;
      text-align: center;
      padding: 16px 20px;
    }

    .kg-section {
      position: relative;
      padding: 92px 0;
    }

    .kg-section--soft { background: var(--kg-bg); }

    .kg-section-head {
      max-width: 880px;
      margin: 0 auto 44px;
      text-align: center;
    }

    .kg-section-head h2 {
      color: var(--kg-navy-deep);
      font-size: clamp(34px, 4vw, 58px);
      line-height: 1.15;
      font-weight: 900;
      letter-spacing: -0.04em;
    }

    .kg-section-head p {
      margin-top: 18px;
      color: var(--kg-muted);
      font-size: 18px;
      line-height: 1.9;
    }

    .kg-stats-grid {
      display: grid;
      grid-template-columns: repeat(2, minmax(0, 1fr));
      gap: 28px;
    }

    .kg-university-grid {
      display: grid;
      grid-template-columns: repeat(3, minmax(0, 1fr));
      gap: 26px;
    }

    .kg-uni-card {
      overflow: hidden;
      border-radius: 24px;
      background: #ffffff;
      border: 1px solid var(--kg-line);
      box-shadow: 0 16px 34px rgba(15, 49, 95, 0.06);
      min-height: 100%;
    }

    .kg-uni-card__head {
      padding: 22px 24px;
      border-bottom: 1px solid var(--kg-line);
      font-size: 18px;
      font-weight: 900;
      line-height: 1.3;
    }

    .kg-uni-card.is-red .kg-uni-card__head {
      color: var(--kg-red);
      background: linear-gradient(180deg, #fff6f7 0%, #fff2f3 100%);
    }

    .kg-uni-card.is-navy .kg-uni-card__head {
      color: var(--kg-navy);
      background: linear-gradient(180deg, #f7faff 0%, #f1f6fd 100%);
    }

    .kg-uni-card__body {
      padding: 20px 24px 24px;
      display: flex;
      flex-direction: column;
      gap: 18px;
    }

    .kg-uni-item strong {
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      gap: 10px;
      font-size: 18px;
      line-height: 1.45;
      font-weight: 900;
      color: var(--kg-ink);
    }

    .kg-uni-item span {
      display: block;
      color: #68788d;
      font-size: 15px;
      line-height: 1.7;
      margin-top: 2px;
    }

    .kg-chip {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      padding: 7px 14px;
      min-height: 34px;
      border-radius: 999px;
      color: #ffffff !important;
      font-size: 13px;
      font-weight: 900;
      line-height: 1;
      letter-spacing: 0.02em;
      text-shadow: none;
      box-shadow: inset 0 1px 0 rgba(255,255,255,0.12), 0 8px 18px rgba(10, 36, 71, 0.12);
    }

    .kg-chip.is-red {
      background: linear-gradient(180deg, #e53f4c 0%, #c72433 100%);
    }

    .kg-chip.is-navy {
      background: linear-gradient(180deg, #1a4a86 0%, #0e3366 100%);
    }

    .kg-interview-grid {
      display: grid;
      grid-template-columns: repeat(3, minmax(0, 1fr));
      gap: 26px;
    }

    .kg-interview-card {
      overflow: hidden;
      border-radius: 24px;
      background: #ffffff;
      border: 1px solid var(--kg-line);
      box-shadow: 0 16px 38px rgba(15, 49, 95, 0.06);
      display: flex;
      flex-direction: column;
      min-height: 100%;
    }

    .kg-interview-thumb {
      aspect-ratio: 16 / 10;
      overflow: hidden;
      background: #dfe7f2;
    }

    .kg-interview-thumb img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .kg-interview-body {
      padding: 24px 24px 26px;
      display: flex;
      flex-direction: column;
      gap: 14px;
      flex: 1;
    }

    .kg-interview-label {
      color: var(--kg-red);
      font-size: 12px;
      font-weight: 800;
      letter-spacing: 0.08em;
      text-transform: uppercase;
    }

    .kg-interview-body h3 {
      color: var(--kg-navy-deep);
      font-size: 22px;
      line-height: 1.45;
      font-weight: 900;
      letter-spacing: -0.02em;
    }

    .kg-interview-body p {
      color: var(--kg-muted);
      font-size: 15px;
      line-height: 1.9;
    }

    .kg-card-link {
      margin-top: auto;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      color: var(--kg-navy-deep) !important;
      font-size: 14px;
      font-weight: 900;
    }

    .kg-interview-cta {
      text-align: center;
      margin-top: 30px;
    }

    .kg-strength {
      background: linear-gradient(180deg, var(--kg-navy) 0%, var(--kg-navy-deep) 100%);
      color: #ffffff;
    }

    .kg-strength .kg-section-head h2,
    .kg-strength .kg-section-head p { color: #ffffff; }

    .kg-strength .kg-section-head p { opacity: 0.86; }

    .kg-strength-grid {
      display: grid;
      grid-template-columns: repeat(4, minmax(0, 1fr));
      gap: 24px;
    }

    .kg-strength-card {
      border-radius: 22px;
      padding: 28px 24px;
      background: rgba(255, 255, 255, 0.1);
      border: 1px solid rgba(255, 255, 255, 0.08);
      box-shadow: inset 0 1px 0 rgba(255,255,255,0.06);
      min-height: 100%;
    }

    .kg-strength-icon {
      width: 58px;
      height: 58px;
      border-radius: 50%;
      background: rgba(255,255,255,0.12);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 24px;
      margin-bottom: 18px;
    }

    .kg-strength-card h3 {
      font-size: 20px;
      line-height: 1.5;
      font-weight: 900;
      margin-bottom: 10px;
    }

    .kg-strength-card p {
      color: rgba(255,255,255,0.82);
      font-size: 15px;
      line-height: 1.9;
    }

    .kg-diagnosis-wrap {
      display: flex;
      justify-content: center;
    }

    .kg-diagnosis-card {
      width: min(840px, 100%);
      border-radius: 30px;
      background: #ffffff;
      border: 1px solid var(--kg-line);
      box-shadow: 0 22px 48px rgba(15, 49, 95, 0.08);
      padding: 54px 56px;
      text-align: center;
    }

    .kg-badges {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 10px;
      margin-top: 18px;
    }

    .kg-badge {
      min-height: 30px;
      padding: 0 12px;
      border-radius: 999px;
      border: 1px solid rgba(15, 49, 95, 0.26);
      color: var(--kg-navy);
      font-size: 12px;
      font-weight: 800;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      background: #ffffff;
    }

    .kg-diagnosis-card p {
      max-width: 650px;
      margin: 22px auto 0;
      color: var(--kg-muted);
      font-size: 18px;
      line-height: 1.9;
    }

    .kg-check-list {
      margin: 28px auto 0;
      max-width: 420px;
      display: flex;
      flex-direction: column;
      gap: 16px;
      text-align: left;
    }

    .kg-check-list li {
      display: flex;
      align-items: flex-start;
      gap: 12px;
      color: var(--kg-ink);
      font-size: 18px;
      font-weight: 700;
      line-height: 1.7;
    }

    .kg-check-list li::before {
      content: "✓";
      flex: 0 0 auto;
      margin-top: 2px;
      width: 28px;
      height: 28px;
      border-radius: 50%;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      background: var(--kg-navy-soft);
      color: var(--kg-navy);
      font-size: 15px;
      font-weight: 900;
    }

    .kg-final-cta {
      padding: 0;
      background: linear-gradient(180deg, #ffffff 0%, #ffffff 10%, transparent 10%);
    }

    .kg-final-cta__panel {
      position: relative;
      overflow: hidden;
      border-radius: 0;
      background:
        radial-gradient(circle at 15% 15%, rgba(255,255,255,0.08), transparent 18%),
        radial-gradient(circle at 82% 20%, rgba(255,255,255,0.08), transparent 18%),
        linear-gradient(135deg, var(--kg-red) 0%, #da3542 100%);
      color: #ffffff;
      text-align: center;
      padding: 88px 20px 92px;
    }

    .kg-final-cta__panel::after {
      content: "";
      position: absolute;
      inset: auto 0 0 0;
      height: 12px;
      background: var(--kg-navy);
    }

    .kg-final-cta h2 {
      font-size: clamp(34px, 4vw, 56px);
      line-height: 1.2;
      font-weight: 900;
      letter-spacing: -0.04em;
    }

    .kg-final-cta p {
      max-width: 780px;
      margin: 20px auto 0;
      color: rgba(255,255,255,0.92);
      font-size: 18px;
      line-height: 1.9;
    }

    .kg-final-cta .kg-btn {
      margin-top: 30px;
      background: #ffffff;
      color: var(--kg-red) !important;
      box-shadow: 0 16px 34px rgba(120, 19, 26, 0.18);
      border: 2px solid rgba(255,255,255,0.7);
    }

    .kg-standalone-footer {
      background: var(--kg-navy);
      color: rgba(255,255,255,0.8);
      padding: 34px 0 42px;
    }

    .kg-footer-inner {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 28px;
      flex-wrap: wrap;
    }

    .kg-footer-brand {
      display: flex;
      align-items: center;
      gap: 18px;
    }

    .kg-footer-brand img {
      width: auto;
      height: 42px;
      filter: brightness(0) invert(1);
      opacity: 0.96;
    }

    .kg-footer-meta {
      display: flex;
      flex-direction: column;
      gap: 8px;
      color: rgba(255,255,255,0.72);
      font-size: 14px;
      line-height: 1.7;
    }

    .kg-footer-links {
      display: flex;
      flex-wrap: wrap;
      gap: 12px;
      justify-content: flex-end;
    }

    .kg-footer-links a {
      min-height: 42px;
      padding: 0 16px;
      border-radius: 999px;
      background: rgba(255,255,255,0.1);
      color: #ffffff !important;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-size: 13px;
      font-weight: 800;
      border: 1px solid rgba(255,255,255,0.08);
    }

    @media (max-width: 1100px) {
      .kg-hero-grid,
      .kg-university-grid,
      .kg-interview-grid,
      .kg-strength-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
      }

      .kg-hero-panel { min-height: 520px; }
      .kg-hero-panel__layout { grid-template-columns: 1fr; }
      .kg-teacher-visual { justify-self: start; width: min(220px, 100%); }
    }

    @media (max-width: 860px) {
      .kg-container { width: min(var(--kg-content), calc(100% - 24px)); }
      .kg-standalone-header__inner { min-height: 74px; }
      .kg-brand img,
      .kg-footer-brand img { height: 36px; }
      .kg-header-nav .kg-btn--outline { display: none; }
      .kg-hero { padding: 34px 0 36px; }
      .kg-hero-grid,
      .kg-stats-grid,
      .kg-university-grid,
      .kg-interview-grid,
      .kg-strength-grid { grid-template-columns: 1fr; }
      .kg-hero-panel { min-height: auto; padding: 24px; }
      .kg-section { padding: 72px 0; }
      .kg-diagnosis-card { padding: 40px 22px; }
      .kg-final-cta__panel { padding: 72px 20px 78px; }
      .kg-footer-inner { flex-direction: column; align-items: flex-start; }
      .kg-footer-links { justify-content: flex-start; }
    }

    @media (max-width: 640px) {
      .kg-btn { width: 100%; min-height: 54px; }
      .kg-standalone-header__inner { flex-wrap: wrap; padding: 14px 0; }
      .kg-header-nav { width: 100%; }
      .kg-hero-title { font-size: clamp(38px, 12vw, 56px); }
      .kg-hero-lead,
      .kg-section-head p,
      .kg-diagnosis-card p,
      .kg-final-cta p { font-size: 16px; }
      .kg-hero-sublead { font-size: 15px; }
      .kg-stat-card,
      .kg-interview-body,
      .kg-uni-card__body,
      .kg-strength-card { padding-left: 20px; padding-right: 20px; }
      .kg-check-list li { font-size: 16px; }
      .kg-teacher-name { font-size: 28px; }
      .kg-teacher-meta span { width: 100%; justify-content: center; }
      .kg-teacher-visual { width: 100%; }
    }
  </style>

<div id="keikyo-about-page" class="ka-page">
<main>
    <section class="kg-hero">
      <div class="kg-container kg-hero-grid">
        <div class="kg-hero-copy">
          <span class="kg-kicker">2025 performance</span>
          <h1 class="kg-hero-title"><span>2025年度</span>合格者実績</h1>
          <p class="kg-hero-lead">総合型選抜で、難関大学合格を実現。</p>
          <p class="kg-hero-sublead">ブルーアカデミーを含むグループ全体の合格実績を掲載しています。</p>

          <div class="kg-hero-stats">
            <article class="kg-stat-card is-red">
              <div class="kg-stat-label"><span class="kg-dot is-red"></span>現役合格率</div>
              <div class="kg-stat-number is-red">100<small>%</small></div>
              <p class="kg-stat-note">2025年度 グループ全体実績</p>
            </article>
            <article class="kg-stat-card is-navy">
              <div class="kg-stat-label"><span class="kg-dot is-navy"></span>難関大学合格率</div>
              <div class="kg-stat-number is-navy">93.3<small>%</small></div>
              <p class="kg-stat-note">2025年度 グループ全体実績</p>
            </article>
          </div>

          <div class="kg-cta-row">
            <a class="kg-btn kg-btn--red" href="<?php echo esc_url($consultation_url); ?>">無料で受験相談する</a>
            <a class="kg-btn kg-btn--contrast" href="<?php echo esc_url($diagnosis_url); ?>">まずは適性診断を受ける</a>
          </div>
        </div>

        <div class="kg-hero-panel" aria-label="主任講師紹介パネル">
          <div class="kg-hero-panel__layout">
            <div class="kg-hero-panel__copy">
              <div class="kg-hero-badge">chief instructor</div>
              <div class="kg-teacher-title">主任講師</div>
              <div class="kg-teacher-name">神崎真桜</div>
              <div class="kg-teacher-meta">
                <span>立教大学卒</span>
                <span>元アクセンチュア株式会社</span>
              </div>
              <p class="kg-teacher-text">総合型選抜の指導に加え、社会で求められる思考力や言語化力まで見据えて伴走する講師として、受験生一人ひとりの可能性を引き出します。</p>
            </div>
            <div class="kg-teacher-visual">
              <img src="<?php echo esc_url($teacher_image_url); ?>" alt="主任講師 神崎真桜">
            </div>
          </div>
        </div>
      </div>
    </section>

    <div class="kg-notice-bar">※掲載している合格実績は、ブルーアカデミーを含むグループ全体の2025年度総合型選抜実績です。</div>

    <section class="kg-section">
      <div class="kg-container">
        <div class="kg-section-head">
          <h2>数字で見る、2025年度の合格実績</h2>
        </div>
        <div class="kg-stats-grid">
          <article class="kg-stat-card is-red">
            <div class="kg-stat-label"><span class="kg-dot is-red"></span>現役合格率</div>
            <div class="kg-stat-number is-red">100<small>%</small></div>
            <p class="kg-stat-note">2025年度 グループ全体実績</p>
          </article>
          <article class="kg-stat-card is-navy">
            <div class="kg-stat-label"><span class="kg-dot is-navy"></span>難関大学合格率</div>
            <div class="kg-stat-number is-navy">93.3<small>%</small></div>
            <p class="kg-stat-note">2025年度 グループ全体実績</p>
          </article>
        </div>
      </div>
    </section>

    <section class="kg-section kg-section--soft">
      <div class="kg-container">
        <div class="kg-section-head">
          <h2>合格実績大学一覧</h2>
          <p>早慶上理から難関国公立、MARCH、芸術系大学まで、幅広い進路で合格実績があります。</p>
        </div>
        <div class="kg-university-grid">
          <?php foreach ($university_groups as $group) : ?>
            <article class="kg-uni-card is-<?php echo esc_attr($group['accent']); ?>">
              <div class="kg-uni-card__head"><?php echo esc_html($group['title']); ?></div>
              <div class="kg-uni-card__body">
                <?php foreach ($group['items'] as $item) : ?>
                  <div class="kg-uni-item">
                    <strong>
                      <?php echo esc_html($item['name']); ?>
                      <?php if (!empty($item['ratio'])) : ?>
                        <span class="kg-chip is-<?php echo esc_attr($group['accent']); ?>"><?php echo esc_html($item['ratio']); ?></span>
                      <?php endif; ?>
                    </strong>
                    <span><?php echo esc_html($item['dept']); ?></span>
                  </div>
                <?php endforeach; ?>
              </div>
            </article>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <section class="kg-section">
      <div class="kg-container">
        <div class="kg-section-head">
          <h2>合格の裏側がわかる、受験生との対談記事</h2>
          <p>偏差値や経歴だけでは語れない、総合型選抜のリアルなストーリーをご覧いただけます。</p>
        </div>
        <div class="kg-interview-grid">
          <?php foreach ($interview_cards as $card) : ?>
            <article class="kg-interview-card">
              <div class="kg-interview-thumb">
                <img src="<?php echo esc_url($card['image']); ?>" alt="<?php echo esc_attr($card['title']); ?>">
              </div>
              <div class="kg-interview-body">
                <div class="kg-interview-label"><?php echo esc_html($card['label']); ?></div>
                <h3><?php echo esc_html($card['title']); ?></h3>
                <p><?php echo esc_html($card['text']); ?></p>
                <a class="kg-card-link" href="<?php echo esc_url($card['url']); ?>">記事を観る →</a>
              </div>
            </article>
          <?php endforeach; ?>
        </div>
        <div class="kg-interview-cta">
          <a class="kg-btn kg-btn--contrast" href="<?php echo esc_url($interview_archive_url); ?>">合格者対談をもっと見る</a>
        </div>
      </div>
    </section>

    <section class="kg-section kg-strength">
      <div class="kg-container">
        <div class="kg-section-head">
          <h2>総合型選抜を経験した大人だからできる指導がある</h2>
          <p>慶教ゼミナールは、総合型選抜の合格経験を持ち、社会人としての経験も豊富な大人が運営しています。総合型選抜を経験した大人は希少であり、受験だけで終わらない視点から、一人ひとりの進路を支えます。</p>
        </div>
        <div class="kg-strength-grid">
          <article class="kg-strength-card">
            <div class="kg-strength-icon">◎</div>
            <h3>合格経験に基づく支援</h3>
            <p>総合型選抜を実際に経験しているからこそ、受験生の悩みや壁を具体的に理解できます。</p>
          </article>
          <article class="kg-strength-card">
            <div class="kg-strength-icon">◌</div>
            <h3>社会人経験のある大人が伴走</h3>
            <p>進学後や将来も見据えながら、志望理由や学びの軸を一緒に深められます。</p>
          </article>
          <article class="kg-strength-card">
            <div class="kg-strength-icon">□</div>
            <h3>志望理由を表面的に終わらせない</h3>
            <p>大学で何を学び、その先をどう描くかまで含めて言語化を支援します。</p>
          </article>
          <article class="kg-strength-card">
            <div class="kg-strength-icon">◇</div>
            <h3>希少性の高い指導体制</h3>
            <p>総合型選抜経験者であり、かつ社会人経験のある大人が支える体制は貴重です。</p>
          </article>
        </div>
      </div>
    </section>

    <section class="kg-section kg-section--soft">
      <div class="kg-container">
        <div class="kg-diagnosis-wrap">
          <div class="kg-diagnosis-card">
            <div class="kg-section-head" style="margin-bottom:0;">
              <h2>あなたの総合型選抜適性を無料診断</h2>
              <div class="kg-badges">
                <span class="kg-badge">3分</span>
                <span class="kg-badge">20問</span>
                <span class="kg-badge">登録不要</span>
              </div>
              <p>今のあなたの強みや課題、向いている学部の方向性がわかる無料診断です。</p>
            </div>
            <ul class="kg-check-list">
              <li>あなたの適性タイプ</li>
              <li>現在の課題と改善点</li>
              <li>強みと弱み</li>
              <li>向いている学部・学科</li>
            </ul>
            <div class="kg-interview-cta">
              <a class="kg-btn kg-btn--navy" href="<?php echo esc_url($diagnosis_url); ?>">無料で適性診断を始める</a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="kg-final-cta">
      <div class="kg-final-cta__panel">
        <div class="kg-container">
          <h2>総合型選抜の対策を、今すぐ始めませんか？</h2>
          <p>志望校や現在地に合わせて、受験戦略を無料で相談できます。まずはお気軽にご相談ください。</p>
          <a class="kg-btn" href="<?php echo esc_url($consultation_url); ?>">無料で受験相談する</a>
        </div>
      </div>
    </section>
  </main>
</div><!-- /#keikyo-about-page -->

<?php get_footer('lp'); ?>
