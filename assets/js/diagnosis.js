/**
 * 総合型選抜適性診断システム - メインロジック
 * 
 * @version 1.0.0
 * @author Keikyo Seminar
 */

(function() {
    'use strict';

    // ======================
    // 診断データ定義
    // ======================

    const DIAGNOSIS_DATA = {
        questions: [
            // 【興味・関心】カテゴリー
            {
                id: 1,
                category: '興味・関心',
                text: '休日に最も魅力を感じる過ごし方は？',
                answers: [
                    { text: '図書館で興味のある分野の本を深く読み込む', scores: { explorer: 3, leader: 0, contributor: 0, creator: 0 } },
                    { text: '友達を誘ってイベントや活動を企画する', scores: { explorer: 0, leader: 3, contributor: 0, creator: 0 } },
                    { text: '地域のボランティア活動に参加する', scores: { explorer: 0, leader: 0, contributor: 3, creator: 0 } },
                    { text: '自分の作品やコンテンツを制作する', scores: { explorer: 0, leader: 0, contributor: 0, creator: 3 } }
                ]
            },
            {
                id: 2,
                category: '興味・関心',
                text: 'ニュースで一番気になるのは？',
                answers: [
                    { text: '最新の研究成果や科学的発見', scores: { explorer: 3, leader: 0, contributor: 0, creator: 0 } },
                    { text: 'ビジネスや経済、政治の動向', scores: { explorer: 0, leader: 3, contributor: 0, creator: 0 } },
                    { text: '社会問題や環境・福祉の話題', scores: { explorer: 0, leader: 0, contributor: 3, creator: 0 } },
                    { text: '芸術・文化・エンタメの新しい表現', scores: { explorer: 0, leader: 0, contributor: 0, creator: 3 } }
                ]
            },
            {
                id: 3,
                category: '興味・関心',
                text: '学校の授業で一番ワクワクするのは？',
                answers: [
                    { text: '「なぜ？」を深く掘り下げる探究的な学び', scores: { explorer: 3, leader: 0, contributor: 0, creator: 0 } },
                    { text: 'グループで議論し、結論を導き出す授業', scores: { explorer: 0, leader: 2, contributor: 1, creator: 0 } },
                    { text: '現実の社会課題について考える授業', scores: { explorer: 0, leader: 0, contributor: 3, creator: 0 } },
                    { text: '自分のアイデアを形にする創作活動', scores: { explorer: 0, leader: 0, contributor: 0, creator: 3 } }
                ]
            },
            {
                id: 4,
                category: '興味・関心',
                text: 'もし1年間自由に使えるとしたら何をしたい？',
                answers: [
                    { text: '興味のあるテーマを徹底的に研究する', scores: { explorer: 3, leader: 0, contributor: 0, creator: 0 } },
                    { text: '新しいプロジェクトを立ち上げて仲間を集める', scores: { explorer: 0, leader: 3, contributor: 0, creator: 0 } },
                    { text: '海外でボランティアや社会貢献活動をする', scores: { explorer: 0, leader: 0, contributor: 3, creator: 0 } },
                    { text: '作品を作り続けて個展や発表会を開く', scores: { explorer: 0, leader: 0, contributor: 0, creator: 3 } }
                ]
            },

            // 【学習スタイル】カテゴリー
            {
                id: 5,
                category: '学習スタイル',
                text: '課題に取り組むとき、あなたのスタイルは？',
                answers: [
                    { text: 'じっくり資料を読み込んで納得するまで調べる', scores: { explorer: 3, leader: 0, contributor: 0, creator: 0 } },
                    { text: 'まず計画を立て、効率的に進める', scores: { explorer: 0, leader: 3, contributor: 0, creator: 0 } },
                    { text: '周りの意見を聞きながら協力して進める', scores: { explorer: 0, leader: 0, contributor: 3, creator: 0 } },
                    { text: '独自の視点で、人と違うアプローチを試す', scores: { explorer: 0, leader: 0, contributor: 0, creator: 3 } }
                ]
            },
            {
                id: 6,
                category: '学習スタイル',
                text: '新しいことを学ぶとき、どんな方法が好き？',
                answers: [
                    { text: '専門書や論文を読んで体系的に理解する', scores: { explorer: 3, leader: 0, contributor: 0, creator: 0 } },
                    { text: '実際にやってみて、経験から学ぶ', scores: { explorer: 0, leader: 2, contributor: 0, creator: 1 } },
                    { text: '人と対話しながら理解を深める', scores: { explorer: 0, leader: 0, contributor: 3, creator: 0 } },
                    { text: '既存の枠にとらわれず、自分なりに解釈する', scores: { explorer: 0, leader: 0, contributor: 0, creator: 3 } }
                ]
            },
            {
                id: 7,
                category: '学習スタイル',
                text: 'グループワークでのあなたの役割は？',
                answers: [
                    { text: '情報を集めて分析し、論理的な提案をする', scores: { explorer: 3, leader: 0, contributor: 0, creator: 0 } },
                    { text: '全体をまとめ、メンバーに役割を振る', scores: { explorer: 0, leader: 3, contributor: 0, creator: 0 } },
                    { text: 'みんなの意見を聞き、調整役になる', scores: { explorer: 0, leader: 0, contributor: 3, creator: 0 } },
                    { text: 'アイデアを出し、創造的な提案をする', scores: { explorer: 0, leader: 0, contributor: 0, creator: 3 } }
                ]
            },
            {
                id: 8,
                category: '学習スタイル',
                text: '難しい問題に直面したとき、どうする？',
                answers: [
                    { text: '原因を突き止めるために徹底的に調べる', scores: { explorer: 3, leader: 0, contributor: 0, creator: 0 } },
                    { text: '解決策を考え、すぐに行動に移す', scores: { explorer: 0, leader: 3, contributor: 0, creator: 0 } },
                    { text: '経験者や先生に相談してアドバイスをもらう', scores: { explorer: 0, leader: 0, contributor: 3, creator: 0 } },
                    { text: '常識にとらわれず、新しい方法を試してみる', scores: { explorer: 0, leader: 0, contributor: 0, creator: 3 } }
                ]
            },

            // 【活動実績・経験】カテゴリー
            {
                id: 9,
                category: '活動実績・経験',
                text: 'これまでで最も達成感を感じた経験は？',
                answers: [
                    { text: '興味のあるテーマを深く調べ、レポートにまとめた', scores: { explorer: 3, leader: 0, contributor: 0, creator: 0 } },
                    { text: 'イベントや活動を企画・運営して成功させた', scores: { explorer: 0, leader: 3, contributor: 0, creator: 0 } },
                    { text: '誰かの役に立ち、感謝された経験', scores: { explorer: 0, leader: 0, contributor: 3, creator: 0 } },
                    { text: '自分の作品が評価され、賞や反響を得た', scores: { explorer: 0, leader: 0, contributor: 0, creator: 3 } }
                ]
            },
            {
                id: 10,
                category: '活動実績・経験',
                text: '部活動や課外活動で大切にしていることは？',
                answers: [
                    { text: '自分のスキルや知識を深めること', scores: { explorer: 3, leader: 0, contributor: 0, creator: 0 } },
                    { text: 'チームをまとめ、目標を達成すること', scores: { explorer: 0, leader: 3, contributor: 0, creator: 0 } },
                    { text: 'メンバー全員が楽しく活動できること', scores: { explorer: 0, leader: 0, contributor: 3, creator: 0 } },
                    { text: '新しい表現や挑戦をすること', scores: { explorer: 0, leader: 0, contributor: 0, creator: 3 } }
                ]
            },
            {
                id: 11,
                category: '活動実績・経験',
                text: '夏休みの自由研究や課題で選ぶテーマは？',
                answers: [
                    { text: '学術的に深掘りできる専門的なテーマ', scores: { explorer: 3, leader: 0, contributor: 0, creator: 0 } },
                    { text: '実社会で役立つ実践的なテーマ', scores: { explorer: 0, leader: 3, contributor: 0, creator: 0 } },
                    { text: '社会課題の解決につながるテーマ', scores: { explorer: 0, leader: 0, contributor: 3, creator: 0 } },
                    { text: '独創的で表現性の高いテーマ', scores: { explorer: 0, leader: 0, contributor: 0, creator: 3 } }
                ]
            },
            {
                id: 12,
                category: '活動実績・経験',
                text: 'SNSで発信するなら、どんな内容？',
                answers: [
                    { text: '学んだ知識や研究内容をわかりやすく解説', scores: { explorer: 3, leader: 0, contributor: 0, creator: 0 } },
                    { text: '目標達成の過程や成功体験をシェア', scores: { explorer: 0, leader: 3, contributor: 0, creator: 0 } },
                    { text: '社会問題への関心を呼びかける投稿', scores: { explorer: 0, leader: 0, contributor: 3, creator: 0 } },
                    { text: '自分の作品やクリエイティブな表現', scores: { explorer: 0, leader: 0, contributor: 0, creator: 3 } }
                ]
            },

            // 【将来志向・価値観】カテゴリー
            {
                id: 13,
                category: '将来志向・価値観',
                text: '将来やってみたいことは？',
                answers: [
                    { text: '専門分野の研究者や学者として新しい発見をする', scores: { explorer: 3, leader: 0, contributor: 0, creator: 0 } },
                    { text: '起業家やリーダーとして社会に影響を与える', scores: { explorer: 0, leader: 3, contributor: 0, creator: 0 } },
                    { text: 'NPOや教育、医療で人々を支える仕事', scores: { explorer: 0, leader: 0, contributor: 3, creator: 0 } },
                    { text: 'アーティストやクリエイターとして表現を追求する', scores: { explorer: 0, leader: 0, contributor: 0, creator: 3 } }
                ]
            },
            {
                id: 14,
                category: '将来志向・価値観',
                text: '大学で最も重視したいことは？',
                answers: [
                    { text: '最先端の研究に触れ、専門性を深めること', scores: { explorer: 3, leader: 0, contributor: 0, creator: 0 } },
                    { text: '実践的なスキルを身につけ、実社会で活躍する力', scores: { explorer: 0, leader: 3, contributor: 0, creator: 0 } },
                    { text: '多様な人と出会い、社会貢献活動に参加すること', scores: { explorer: 0, leader: 0, contributor: 3, creator: 0 } },
                    { text: '自由な環境で自分の表現を磨くこと', scores: { explorer: 0, leader: 0, contributor: 0, creator: 3 } }
                ]
            },
            {
                id: 15,
                category: '将来志向・価値観',
                text: 'あなたが最も大切にしている価値観は？',
                answers: [
                    { text: '真実を追求し、深く理解すること', scores: { explorer: 3, leader: 0, contributor: 0, creator: 0 } },
                    { text: '目標を達成し、結果を出すこと', scores: { explorer: 0, leader: 3, contributor: 0, creator: 0 } },
                    { text: '誰かの役に立ち、社会をより良くすること', scores: { explorer: 0, leader: 0, contributor: 3, creator: 0 } },
                    { text: '自分らしさを表現し、独創性を大切にすること', scores: { explorer: 0, leader: 0, contributor: 0, creator: 3 } }
                ]
            }
        ],

        // タイプ別の詳細情報
        types: {
            explorer: {
                name: '探究者タイプ',
                description: 'あなたは物事の本質を深く理解しようとする探究心の持ち主です。「なぜ？」という問いを大切にし、論理的に考えることが得意。学術的な総合型選抜に向いています。',
                strengths: [
                    '深い思考力と論理的な分析能力',
                    '知的好奇心が旺盛で学習意欲が高い',
                    '専門的な知識を体系的に理解できる',
                    '長期的な研究や探究に粘り強く取り組める'
                ],
                activities: [
                    '興味のある分野の論文やレポート執筆',
                    '学会や研究発表会への参加',
                    'オンライン講座（Coursera、edX等）での専門学習',
                    '科学オリンピックや学術コンテストへの挑戦'
                ],
                preparation: [
                    '興味のあるテーマで探究活動を始める',
                    '研究計画書の書き方を学ぶ',
                    '大学教授の著書や論文を読む',
                    '志望理由書で「なぜその研究がしたいか」を明確に'
                ],
                faculties: [
                    '理学部（数学、物理学、化学、生物学）',
                    '文学部（哲学、歴史学、言語学）',
                    '法学部、経済学部',
                    '工学部、情報学部'
                ],
                color: '#4A90E2'
            },
            leader: {
                name: 'リーダータイプ',
                description: 'あなたは行動力と実行力に優れ、チームをまとめる力を持っています。目標達成に向けて計画的に動き、周囲を巻き込むことが得意。実践的な総合型選抜に向いています。',
                strengths: [
                    '高い行動力と実行力',
                    'チームをまとめるリーダーシップ',
                    '計画的に物事を進める能力',
                    '課題解決に向けた現実的な思考'
                ],
                activities: [
                    '生徒会や委員会でのリーダー経験',
                    'イベント・プロジェクトの企画運営',
                    'ビジネスコンテストへの参加',
                    'インターンシップや起業体験プログラム'
                ],
                preparation: [
                    'リーダー経験を具体的にまとめる',
                    'プロジェクトの成果を数値で示す準備',
                    'チームで達成した実績を整理',
                    '面接で自分のリーダーシップを語れるようにする'
                ],
                faculties: [
                    '経営学部、商学部',
                    '政治学部、国際関係学部',
                    '工学部（プロジェクトマネジメント系）',
                    '総合政策学部'
                ],
                color: '#E94B3C'
            },
            contributor: {
                name: '貢献者タイプ',
                description: 'あなたは人や社会のために尽くすことに喜びを感じる心優しい人です。共感力が高く、協調性に優れています。社会貢献型の総合型選抜に向いています。',
                strengths: [
                    '高い共感力と人への思いやり',
                    '社会課題への関心と問題意識',
                    'チームで協力して動ける協調性',
                    '他者の意見を尊重しながら調整する力'
                ],
                activities: [
                    '地域ボランティア活動への参加',
                    'NPO・NGOでの活動経験',
                    '福祉施設や子どもへの支援活動',
                    '環境保護や国際協力のプロジェクト'
                ],
                preparation: [
                    'ボランティア経験を記録・整理する',
                    '社会課題について自分の考えをまとめる',
                    '活動を通じて学んだことを言語化',
                    '「なぜその活動をしたのか」動機を明確に'
                ],
                faculties: [
                    '社会学部、福祉学部',
                    '教育学部',
                    '医学部、看護学部、保健学部',
                    '国際関係学部、国際協力学部'
                ],
                color: '#6BBF59'
            },
            creator: {
                name: 'クリエイタータイプ',
                description: 'あなたは独創的な発想と表現力を持つクリエイターです。既存の枠にとらわれず、自分らしさを大切にします。芸術・表現系の総合型選抜に向いています。',
                strengths: [
                    '独創的なアイデアと発想力',
                    '芸術的感性と表現への情熱',
                    '既存の枠にとらわれない柔軟な思考',
                    '自分らしさを貫く個性と信念'
                ],
                activities: [
                    '作品制作（絵画、音楽、映像、文章など）',
                    'コンテストや公募展への応募',
                    'SNSやブログでの作品発信',
                    'デザインやアート系のワークショップ参加'
                ],
                preparation: [
                    'ポートフォリオ（作品集）を作成',
                    '作品に込めた想いやコンセプトを言語化',
                    '表現活動の継続と記録',
                    '自分の表現スタイルを確立する'
                ],
                faculties: [
                    '芸術学部、美術学部',
                    'デザイン学部、建築学部',
                    '文学部（創作系）',
                    'メディア学部、映像学部'
                ],
                color: '#9B59B6'
            }
        }
    };

    // ======================
    // 状態管理
    // ======================

    let currentQuestionIndex = 0;
    let userAnswers = [];
    let scores = {
        explorer: 0,
        leader: 0,
        contributor: 0,
        creator: 0
    };

    // ======================
    // DOM要素
    // ======================

    const elements = {
        intro: document.getElementById('diagnosis-intro'),
        quiz: document.getElementById('diagnosis-quiz'),
        result: document.getElementById('diagnosis-result'),
        loading: document.getElementById('diagnosis-loading'),
        
        startBtn: document.getElementById('start-diagnosis-btn'),
        prevBtn: document.getElementById('prev-btn'),
        nextBtn: document.getElementById('next-btn'),
        restartBtn: document.getElementById('restart-btn'),
        
        progressFill: document.getElementById('progress-fill'),
        currentQuestionNum: document.getElementById('current-question'),
        questionText: document.getElementById('question-text'),
        answersContainer: document.getElementById('answers-container'),
        
        resultTypeBadge: document.getElementById('result-type-badge'),
        resultDescription: document.getElementById('result-description'),
        resultStrengths: document.getElementById('result-strengths'),
        resultActivities: document.getElementById('result-activities'),
        resultPreparation: document.getElementById('result-preparation'),
        resultFaculties: document.getElementById('result-faculties')
    };

    // ======================
    // 初期化
    // ======================

    function init() {
        // イベントリスナー設定
        elements.startBtn.addEventListener('click', startDiagnosis);
        elements.prevBtn.addEventListener('click', prevQuestion);
        elements.nextBtn.addEventListener('click', nextQuestion);
        elements.restartBtn.addEventListener('click', restartDiagnosis);
        
        console.log('診断システム初期化完了');
    }

    // ======================
    // 画面遷移
    // ======================

    function showSection(sectionName) {
        elements.intro.classList.remove('active');
        elements.quiz.classList.remove('active');
        elements.result.classList.remove('active');
        
        if (sectionName === 'intro') {
            elements.intro.classList.add('active');
        } else if (sectionName === 'quiz') {
            elements.quiz.classList.add('active');
        } else if (sectionName === 'result') {
            elements.result.classList.add('active');
        }
    }

    function showLoading() {
        elements.loading.style.display = 'flex';
    }

    function hideLoading() {
        elements.loading.style.display = 'none';
    }

    // ======================
    // 診断開始
    // ======================

    function startDiagnosis() {
        currentQuestionIndex = 0;
        userAnswers = [];
        scores = { explorer: 0, leader: 0, contributor: 0, creator: 0 };
        
        showSection('quiz');
        renderQuestion();
    }

    // ======================
    // 質問表示
    // ======================

    function renderQuestion() {
        const question = DIAGNOSIS_DATA.questions[currentQuestionIndex];
        
        const progress = ((currentQuestionIndex + 1) / DIAGNOSIS_DATA.questions.length) * 100;
        elements.progressFill.style.width = progress + '%';
        elements.currentQuestionNum.textContent = currentQuestionIndex + 1;
        
        elements.questionText.textContent = question.text;
        
        elements.answersContainer.innerHTML = '';
        question.answers.forEach((answer, index) => {
            const answerBtn = document.createElement('button');
            answerBtn.className = 'answer-btn';
            answerBtn.textContent = answer.text;
            answerBtn.dataset.index = index;
            
            if (userAnswers[currentQuestionIndex] === index) {
                answerBtn.classList.add('selected');
                elements.nextBtn.disabled = false;
            }
            
            answerBtn.addEventListener('click', () => selectAnswer(index));
            elements.answersContainer.appendChild(answerBtn);
        });
        
        elements.prevBtn.style.display = currentQuestionIndex > 0 ? 'inline-block' : 'none';
        
        if (currentQuestionIndex === DIAGNOSIS_DATA.questions.length - 1) {
            elements.nextBtn.textContent = '結果を見る';
        } else {
            elements.nextBtn.textContent = '次の質問 →';
        }
        
        elements.answersContainer.style.opacity = '0';
        setTimeout(() => {
            elements.answersContainer.style.opacity = '1';
        }, 100);
    }

    // ======================
    // 回答選択
    // ======================

    function selectAnswer(answerIndex) {
        const answerBtns = elements.answersContainer.querySelectorAll('.answer-btn');
        answerBtns.forEach((btn, idx) => {
            if (idx === answerIndex) {
                btn.classList.add('selected');
            } else {
                btn.classList.remove('selected');
            }
        });
        
        userAnswers[currentQuestionIndex] = answerIndex;
        elements.nextBtn.disabled = false;
    }

    // ======================
    // ナビゲーション
    // ======================

    function prevQuestion() {
        if (currentQuestionIndex > 0) {
            currentQuestionIndex--;
            elements.nextBtn.disabled = false;
            renderQuestion();
        }
    }

    function nextQuestion() {
        if (userAnswers[currentQuestionIndex] === undefined) {
            return;
        }
        
        if (currentQuestionIndex === DIAGNOSIS_DATA.questions.length - 1) {
            calculateResult();
            return;
        }
        
        currentQuestionIndex++;
        elements.nextBtn.disabled = userAnswers[currentQuestionIndex] === undefined;
        renderQuestion();
    }

    // ======================
    // 結果計算
    // ======================

    function calculateResult() {
        showLoading();
        
        DIAGNOSIS_DATA.questions.forEach((question, qIndex) => {
            const answerIndex = userAnswers[qIndex];
            const answer = question.answers[answerIndex];
            
            scores.explorer += answer.scores.explorer;
            scores.leader += answer.scores.leader;
            scores.contributor += answer.scores.contributor;
            scores.creator += answer.scores.creator;
        });
        
        const resultType = Object.keys(scores).reduce((a, b) => 
            scores[a] > scores[b] ? a : b
        );
        
        console.log('診断結果:', resultType, scores);
        
        saveDiagnosisResult(resultType, scores, userAnswers);
        
        setTimeout(() => {
            hideLoading();
            displayResult(resultType);
        }, 1500);
    }

    // ======================
    // 結果表示
    // ======================

    function displayResult(resultType) {
        const typeData = DIAGNOSIS_DATA.types[resultType];
        
        elements.resultTypeBadge.textContent = typeData.name;
        elements.resultTypeBadge.style.backgroundColor = typeData.color;
        
        elements.resultDescription.textContent = typeData.description;
        
        elements.resultStrengths.innerHTML = typeData.strengths
            .map(item => `<div class="result-item">✓ ${item}</div>`)
            .join('');
        
        elements.resultActivities.innerHTML = typeData.activities
            .map(item => `<div class="result-item">• ${item}</div>`)
            .join('');
        
        elements.resultPreparation.innerHTML = typeData.preparation
            .map(item => `<div class="result-item">□ ${item}</div>`)
            .join('');
        
        elements.resultFaculties.innerHTML = typeData.faculties
            .map(item => `<div class="result-item">🎓 ${item}</div>`)
            .join('');
        
        showSection('result');
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    // ======================
    // データ保存（Ajax）
    // ======================

    function saveDiagnosisResult(resultType, scores, answers) {
        if (typeof diagnosisAjax === 'undefined') {
            console.log('Ajax未設定: データ保存スキップ');
            return;
        }
        
        const data = {
            action: 'save_diagnosis_result',
            nonce: diagnosisAjax.nonce,
            result_type: resultType,
            scores: scores,
            answers: answers,
            user_agent: navigator.userAgent,
            referrer: document.referrer
        };
        
        fetch(diagnosisAjax.ajaxurl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams(data)
        })
        .then(response => response.json())
        .then(result => {
            console.log('診断結果保存成功:', result);
        })
        .catch(error => {
            console.error('診断結果保存エラー:', error);
        });
    }

    // ======================
    // 再診断
    // ======================

    function restartDiagnosis() {
        currentQuestionIndex = 0;
        userAnswers = [];
        scores = { explorer: 0, leader: 0, contributor: 0, creator: 0 };
        
        showSection('intro');
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    // ======================
    // DOMContentLoaded
    // ======================

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

})();
