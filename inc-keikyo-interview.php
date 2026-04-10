<?php
/**
 * 慶教ゼミナール 合格者対談 実装コア
 *
 * Design reminder:
 * - 可変テンプレートを最優先し、未入力時は自然に縮退させる。
 * - 標準本文ではなく、Meta Box による構造化入力を前提とする。
 * - 赤×紺のエディトリアル基調と、相談導線の強さを両立する。
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'keikyo_interview_text_field' ) ) {
	function keikyo_interview_text_field( $id, $name, $required = false, $desc = '', $type = 'text' ) {
		return array(
			'id'       => $id,
			'name'     => $name,
			'type'     => $type,
			'required' => (bool) $required,
			'desc'     => $desc,
		);
	}
}

if ( ! function_exists( 'keikyo_interview_textarea_field' ) ) {
	function keikyo_interview_textarea_field( $id, $name, $required = false, $desc = '', $rows = 4 ) {
		return array(
			'id'       => $id,
			'name'     => $name,
			'type'     => 'textarea',
			'required' => (bool) $required,
			'desc'     => $desc,
			'rows'     => $rows,
		);
	}
}

if ( ! function_exists( 'keikyo_interview_checkbox_field' ) ) {
	function keikyo_interview_checkbox_field( $id, $name, $desc = '', $default = false ) {
		return array(
			'id'   => $id,
			'name' => $name,
			'type' => 'checkbox',
			'desc' => $desc,
			'std'  => $default ? 1 : 0,
		);
	}
}

if ( ! function_exists( 'keikyo_interview_url_field' ) ) {
	function keikyo_interview_url_field( $id, $name, $required = false, $desc = '' ) {
		return array(
			'id'       => $id,
			'name'     => $name,
			'type'     => 'url',
			'required' => (bool) $required,
			'desc'     => $desc,
		);
	}
}

if ( ! function_exists( 'keikyo_interview_image_field' ) ) {
	function keikyo_interview_image_field( $id, $name, $desc = '' ) {
		return array(
			'id'               => $id,
			'name'             => $name,
			'type'             => 'single_image',
			'desc'             => $desc,
			'force_delete'     => false,
			'max_file_uploads' => 1,
		);
	}
}

if ( ! function_exists( 'keikyo_interview_group_field' ) ) {
	function keikyo_interview_group_field( $id, $name, $fields, $args = array() ) {
		$defaults = array(
			'id'            => $id,
			'name'          => $name,
			'type'          => 'group',
			'fields'        => $fields,
			'collapsible'   => true,
			'save_state'    => true,
			'default_state' => 'expanded',
		);

		return array_merge( $defaults, $args );
	}
}

if ( ! function_exists( 'keikyo_register_interview_post_type' ) ) {
	function keikyo_register_interview_post_type() {
		$labels = array(
			'name'               => '合格者対談一覧',
			'singular_name'      => '合格者対談記事',
			'menu_name'          => '合格者対談',
			'name_admin_bar'     => '合格者対談',
			'add_new'            => '新規追加',
			'add_new_item'       => '合格者対談記事を追加',
			'new_item'           => '新しい合格者対談記事',
			'edit_item'          => '合格者対談記事を編集',
			'view_item'          => '合格者対談記事を表示',
			'all_items'          => '合格者対談一覧',
			'search_items'       => '合格者対談を検索',
			'not_found'          => '合格者対談記事が見つかりません。',
			'not_found_in_trash' => 'ゴミ箱に合格者対談記事はありません。',
		);

		register_post_type(
			'interview',
			array(
				'labels'             => $labels,
				'public'             => true,
				'has_archive'        => true,
				'show_in_rest'       => true,
				'menu_position'      => 5,
				'menu_icon'          => 'dashicons-format-chat',
				'rewrite'            => array(
					'slug'       => 'interview',
					'with_front' => false,
				),
'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'revisions' ),
					'taxonomies'         => array( 'category', 'post_tag' ),
					'publicly_queryable' => true,

				'show_ui'            => true,
				'show_in_menu'       => true,
			)
		);

		register_taxonomy(
			'interview_category',
			'interview',
			array(
				'label'        => '対談カテゴリ',
				'labels'       => array(
					'name'          => '対談カテゴリ',
					'singular_name' => '対談カテゴリ',
				),
				'public'       => true,
				'hierarchical' => true,
				'show_in_rest' => true,
				'rewrite'      => array(
					'slug' => 'interview-category',
				),
			)
		);

		register_taxonomy(
			'interview_university',
			'interview',
			array(
				'label'        => '大学別導線',
				'labels'       => array(
					'name'          => '大学別導線',
					'singular_name' => '大学別導線',
				),
				'public'       => true,
				'hierarchical' => true,
				'show_in_rest' => true,
				'rewrite'      => array(
					'slug' => 'interview-university',
				),
			)
		);

		register_taxonomy(
			'interview_admission_type',
			'interview',
			array(
				'label'        => '入試方式別導線',
				'labels'       => array(
					'name'          => '入試方式別導線',
					'singular_name' => '入試方式別導線',
				),
				'public'       => true,
				'hierarchical' => true,
				'show_in_rest' => true,
				'rewrite'      => array(
					'slug' => 'interview-admission-type',
				),
			)
		);
	}
}
add_action( 'init', 'keikyo_register_interview_post_type' );

if ( ! function_exists( 'keikyo_attach_interview_to_core_taxonomies' ) ) {
	function keikyo_attach_interview_to_core_taxonomies() {
		register_taxonomy_for_object_type( 'category', 'interview' );
		register_taxonomy_for_object_type( 'post_tag', 'interview' );
	}
}
add_action( 'init', 'keikyo_attach_interview_to_core_taxonomies', 20 );

if ( ! function_exists( 'keikyo_include_interview_in_term_archives' ) ) {
	function keikyo_include_interview_in_term_archives( $query ) {
		if ( is_admin() || ! $query->is_main_query() ) {
			return;
		}

		if ( ! $query->is_category() && ! $query->is_tag() ) {
			return;
		}

		$post_types = $query->get( 'post_type' );

		if ( empty( $post_types ) ) {
			$post_types = array( 'post', 'interview' );
		} elseif ( is_string( $post_types ) ) {
			$post_types = array( $post_types );
		}

		if ( is_array( $post_types ) && ! in_array( 'interview', $post_types, true ) ) {
			$post_types[] = 'interview';
		}

		$query->set( 'post_type', $post_types );
	}
}
add_action( 'pre_get_posts', 'keikyo_include_interview_in_term_archives' );

if ( ! function_exists( 'keikyo_register_interview_meta_boxes' ) ) {
	function keikyo_register_interview_meta_boxes( $meta_boxes ) {
		$meta_boxes[] = array(
			'title'      => '合格者対談ページ設定',
			'id'         => 'keikyo_interview_settings',
			'post_types' => array( 'interview' ),
			'context'    => 'normal',
			'priority'   => 'high',
			'closed'     => false,
			'autosave'   => true,
			'fields'     => array(
				keikyo_interview_group_field(
					'hero_section',
					'1. ファーストビュー',
					array(
						keikyo_interview_text_field( 'hero_display_title', '本番表示用タイトル', true, 'フロント表示専用。記事タイトル（画面最上部のタイトル入力欄）がH1として使われます。' ),
						keikyo_interview_text_field( 'hero_display_subtitle', '本番表示用サブタイトル', true, 'フロント表示専用。通常の太さでタイトル下に表示します。' ),
						keikyo_interview_textarea_field( 'hero_description', 'ディスクリプション', false, '一覧・抜粋・SEO説明文の共通原稿として使う想定です。120〜160字目安', 4 ),
						keikyo_interview_textarea_field( 'hero_lead_text', 'リード文', true, '300文字以内', 4 ),
						keikyo_interview_image_field( 'hero_image', '合格者写真', '必須' ),
						keikyo_interview_text_field( 'hero_info_school', '合格者簡易情報1「出身校」', true, '' ),
						keikyo_interview_text_field( 'hero_info_result', '合格者簡易情報2「合格大学/学部/学科/専攻」', true, '学部学科専攻も記載' ),
						array(
							'id'       => 'hero_info_admission_type',
							'name'     => '合格者簡易情報3「入試方式」',
							'type'     => 'select',
							'required' => true,
							'desc'     => '選択式',
							'options'  => array(
								'総合型選抜'     => '総合型選抜',
								'学校推薦型選抜' => '学校推薦型選抜',
								'一般選抜'       => '一般選抜',
							),
						),
						keikyo_interview_text_field( 'hero_info_period', '合格者簡易情報4「準備期間」', true, '' ),
					)
				),
				keikyo_interview_group_field(
					'contents_section',
					'2. Contents',
					array(
						keikyo_interview_text_field( 'contents_story', 'リアルなストーリー', true, '50字以内' ),
						keikyo_interview_text_field( 'contents_inquiry', '探究活動の作り方', true, '50字以内' ),
						keikyo_interview_text_field( 'contents_reason', '志望理由書の秘訣', true, '50字以内' ),
						keikyo_interview_text_field( 'contents_strategy', '受験戦略と面接対策', true, '50字以内' ),
						keikyo_interview_group_field(
							'contents_recommended_items',
							'こんな人におすすめ（対象明記）',
							array(
								keikyo_interview_text_field( 'recommended_text', 'こんな人におすすめ（対象明記）', true, '50字以内' )
							),
							array(
								'clone'       => true,
								'sort_clone'  => true,
								'collapsible' => true,
								'group_title' => '追加文章 {#}: {recommended_text}',
								'min_clone'   => 1,
								'add_button'  => '追加する',
							)
						),
						keikyo_interview_url_field( 'contents_youtube_url', '合格者対談動画', false, 'YouTube URL' )
					)
				),
				keikyo_interview_group_field(
					'key_points_section',
					'3. Key Points',
					array(
						keikyo_interview_text_field( 'key_point_1_title', '合格の決め手１タイトル', true, '30字以内' ),
						keikyo_interview_textarea_field( 'key_point_1_body', '合格の決め手１本文', true, '80字以内', 3 ),
						keikyo_interview_text_field( 'key_point_2_title', '合格の決め手2タイトル', true, '30字以内' ),
						keikyo_interview_textarea_field( 'key_point_2_body', '合格の決め手2本文', true, '80字以内', 3 ),
						keikyo_interview_text_field( 'key_point_3_title', '合格の決め手3タイトル', true, '30字以内' ),
						keikyo_interview_textarea_field( 'key_point_3_body', '合格の決め手3本文', true, '80字以内', 3 )
					)
				),
				keikyo_interview_group_field(
					'profile_section',
					'4. Profile',
					array(
						keikyo_interview_image_field( 'student_profile_image', '合格者写真', '' ),
						keikyo_interview_textarea_field( 'student_quote', '合格者の言葉', true, '50字以内', 3 ),
						keikyo_interview_text_field( 'student_name', '氏名', true, '' ),
						keikyo_interview_text_field( 'student_name_kana', 'ふりがな', true, '' ),
						keikyo_interview_text_field( 'student_school', '出身高校', false, '' ),
						keikyo_interview_text_field( 'student_result', '合格大学・学部', true, '' ),
						keikyo_interview_text_field( 'student_admission_type', '入試方式', true, '' ),
						keikyo_interview_text_field( 'student_first_choice', '第一志望', false, '' ),
						keikyo_interview_text_field( 'student_english_score', '英語資格', false, '' ),
						keikyo_interview_text_field( 'student_final_gpa', '最終評定平均', false, '' ),
						keikyo_interview_text_field( 'student_club', '部活', false, '' ),
						keikyo_interview_text_field( 'student_prep_period', '準備期間', false, '' ),
						keikyo_interview_text_field( 'student_gpa', '評定平均', false, '' ),
						keikyo_interview_text_field( 'student_other_choices', '併願戦略', false, '' ),
						keikyo_interview_text_field( 'student_deviation_3', '３教科偏差値', false, '' ),
						keikyo_interview_text_field( 'student_deviation_5', '５教科偏差値', false, '' ),
						keikyo_interview_group_field(
							'student_activity_chips',
							'主な活動実績',
							array(
								keikyo_interview_text_field( 'activity_chip_label', '主な活動実績', false, '20字以内' )
							),
							array(
								'clone'       => true,
								'sort_clone'  => true,
								'collapsible' => true,
								'group_title' => '主な活動実績 {#}: {activity_chip_label}',
								'add_button'  => '追加する',
							)
						)
					)
				),
				keikyo_interview_group_field(
					'timeline_section',
					'5. Story Timeline',
					array(
						keikyo_interview_group_field(
							'timeline_items',
							'ストーリー',
							array(
								array(
									'id'      => 'timeline_keyword',
									'name'    => 'ストーリーキーワード',
									'type'    => 'select',
									'desc'    => '選択式',
									'options' => array(
										'原点となる体験' => '原点となる体験',
										'最大の転機'     => '最大の転機',
										'実績のピーク'   => '実績のピーク',
										'合格'           => '合格',
									),
								),
								keikyo_interview_text_field( 'timeline_period', 'ストーリー時期', false, '中３冬、高１夏など' ),
								keikyo_interview_text_field( 'timeline_item_title', 'ストーリータイトル', false, '25字以内' ),
								keikyo_interview_textarea_field( 'timeline_item_body', 'ストーリー本文', false, '85字以内', 4 )
							),
							array(
								'clone'       => true,
								'sort_clone'  => true,
								'collapsible' => true,
								'group_title' => 'ストーリー {#}: {timeline_item_title}',
								'add_button'  => 'ストーリーを追加',
							)
						)
					)
				),
				keikyo_interview_group_field(
					'message_section',
					'6. Message',
					array(
						keikyo_interview_image_field( 'message_advisor_image', '塾長写真', '' ),
						keikyo_interview_url_field( 'message_youtube_url', 'YouTubeメッセージ動画', false, 'https://youtu.be/pzCY6DJS0q0?si=HaB_SUkJBjjmYRVS' )
					)
				),
				keikyo_interview_group_field(
					'final_cta_section',
					'7. 下段CTA',
					array(
						keikyo_interview_url_field( 'final_cta_primary_url', 'ボタンURL', false, 'https://lp.keikyo-seminar.jp/main01/' )
					)
				),
			)
		);

		return $meta_boxes;
	}

}
add_filter( 'rwmb_meta_boxes', 'keikyo_register_interview_meta_boxes' );

if ( ! function_exists( 'keikyo_interview_get_group' ) ) {
	function keikyo_interview_get_group( $post_id, $field_name ) {
		$group = array();

		if ( function_exists( 'rwmb_meta' ) ) {
			$rwmb_group = rwmb_meta( $field_name, array(), $post_id );
			if ( is_array( $rwmb_group ) ) {
				$group = $rwmb_group;
			}
		}

		$raw_group = get_post_meta( $post_id, $field_name, true );
		if ( is_array( $raw_group ) && ! empty( $raw_group ) ) {
			$group = empty( $group ) ? $raw_group : array_replace_recursive( $group, $raw_group );
		}

		return is_array( $group ) ? $group : array();
	}
}

if ( ! function_exists( 'keikyo_interview_sync_message_section_meta' ) ) {
	function keikyo_interview_sync_message_section_meta( $post_id ) {
		if ( wp_is_post_revision( $post_id ) || ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) ) {
			return;
		}

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		if ( ! isset( $_POST['message_section'] ) || ! is_array( $_POST['message_section'] ) ) {
			return;
		}

		$message_section = wp_unslash( $_POST['message_section'] );
		$normalized      = array();

		if ( isset( $message_section['message_advisor_image'] ) ) {
			$normalized['message_advisor_image'] = $message_section['message_advisor_image'];
		}

		if ( isset( $message_section['message_youtube_url'] ) ) {
			$normalized['message_youtube_url'] = esc_url_raw( trim( (string) $message_section['message_youtube_url'] ) );
		}

		if ( ! empty( $normalized ) ) {
			update_post_meta( $post_id, 'message_section', $normalized );
		}
	}
}
add_action( 'save_post_interview', 'keikyo_interview_sync_message_section_meta', 50 );

if ( ! function_exists( 'keikyo_interview_sync_description_to_excerpt' ) ) {
	function keikyo_interview_sync_description_to_excerpt( $post_id ) {
		if ( wp_is_post_revision( $post_id ) || ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) ) {
			return;
		}

		if ( 'interview' !== get_post_type( $post_id ) ) {
			return;
		}

		$hero_section = function_exists( 'rwmb_meta' ) ? rwmb_meta( 'hero_section', array(), $post_id ) : array();
		$description  = '';

		if ( is_array( $hero_section ) && isset( $hero_section['hero_description'] ) ) {
			$description = trim( wp_strip_all_tags( (string) $hero_section['hero_description'] ) );
		}

		$post = get_post( $post_id );
		if ( ! $post instanceof WP_Post ) {
			return;
		}

		if ( $description === trim( (string) $post->post_excerpt ) ) {
			return;
		}

		remove_action( 'save_post_interview', 'keikyo_interview_sync_description_to_excerpt', 60 );
		wp_update_post(
			array(
				'ID'           => $post_id,
				'post_excerpt' => $description,
			)
		);
		add_action( 'save_post_interview', 'keikyo_interview_sync_description_to_excerpt', 60 );
	}
}
add_action( 'save_post_interview', 'keikyo_interview_sync_description_to_excerpt', 60 );

if ( ! function_exists( 'keikyo_interview_get_nested_value' ) ) {
	function keikyo_interview_get_nested_value( $source, $key, $default = '' ) {
		if ( ! is_array( $source ) || ! array_key_exists( $key, $source ) ) {
			return $default;
		}

		$value = $source[ $key ];

		if ( is_string( $value ) ) {
			$value = trim( $value );
		}

		return '' === $value || null === $value ? $default : $value;
	}
}

if ( ! function_exists( 'keikyo_interview_normalize_repeater' ) ) {
	function keikyo_interview_normalize_repeater( $rows, $required_keys = array() ) {
		if ( ! is_array( $rows ) ) {
			return array();
		}

		$normalized = array();

		foreach ( $rows as $row ) {
			if ( ! is_array( $row ) ) {
				continue;
			}

			$is_valid = true;

			foreach ( $required_keys as $required_key ) {
				$value = keikyo_interview_get_nested_value( $row, $required_key, '' );
				if ( '' === $value && ! is_array( $value ) ) {
					$is_valid = false;
					break;
				}
			}

			if ( $is_valid ) {
				$normalized[] = $row;
			}
		}

		return $normalized;
	}
}

if ( ! function_exists( 'keikyo_interview_has_complete_button' ) ) {
	function keikyo_interview_has_complete_button( $label, $url ) {
		return '' !== trim( (string) $label ) && '' !== trim( (string) $url );
	}
}

if ( ! function_exists( 'keikyo_interview_get_image_url' ) ) {
	function keikyo_interview_get_image_url( $image, $size = 'large' ) {
		if ( empty( $image ) ) {
			return '';
		}

		if ( is_array( $image ) ) {
			if ( isset( $image['full_url'] ) && '' !== (string) $image['full_url'] ) {
				return $image['full_url'];
			}
			if ( isset( $image['sizes'][ $size ] ) ) {
				return $image['sizes'][ $size ];
			}
			if ( isset( $image['url'] ) ) {
				return $image['url'];
			}
			if ( isset( $image['ID'] ) ) {
				$image_src = wp_get_attachment_image_url( (int) $image['ID'], 'full' );
				if ( $image_src ) {
					return $image_src;
				}
				$image_src = wp_get_attachment_image_url( (int) $image['ID'], $size );
				return $image_src ? $image_src : '';
			}
		}

		if ( is_numeric( $image ) ) {
			$image_src = wp_get_attachment_image_url( (int) $image, 'full' );
			if ( $image_src ) {
				return $image_src;
			}
			$image_src = wp_get_attachment_image_url( (int) $image, $size );
			return $image_src ? $image_src : '';
		}

		return is_string( $image ) ? $image : '';
	}
}

if ( ! function_exists( 'keikyo_interview_get_image_alt' ) ) {
	function keikyo_interview_get_image_alt( $image, $fallback = '' ) {
		if ( is_array( $image ) && ! empty( $image['alt'] ) ) {
			return $image['alt'];
		}

		if ( is_array( $image ) && ! empty( $image['ID'] ) ) {
			$alt = get_post_meta( (int) $image['ID'], '_wp_attachment_image_alt', true );
			return $alt ? $alt : $fallback;
		}

		if ( is_numeric( $image ) ) {
			$alt = get_post_meta( (int) $image, '_wp_attachment_image_alt', true );
			return $alt ? $alt : $fallback;
		}

		return $fallback;
	}
}

if ( ! function_exists( 'keikyo_interview_section_hidden' ) ) {
	function keikyo_interview_section_hidden( $slug, $display_controls ) {
		$hidden = isset( $display_controls['force_hide_sections'] ) && is_array( $display_controls['force_hide_sections'] )
			? $display_controls['force_hide_sections']
			: array();

		return in_array( $slug, $hidden, true );
	}
}

if ( ! function_exists( 'keikyo_interview_build_context' ) ) {
	function keikyo_interview_build_context( $post_id = 0 ) {
		$post_id = $post_id ? $post_id : get_the_ID();

			$hero_section      = keikyo_interview_get_group( $post_id, 'hero_section' );
			$contents_section  = keikyo_interview_get_group( $post_id, 'contents_section' );
			$key_points_group  = keikyo_interview_get_group( $post_id, 'key_points_section' );
			$profile_section   = keikyo_interview_get_group( $post_id, 'profile_section' );
			$timeline_section  = keikyo_interview_get_group( $post_id, 'timeline_section' );
			$message_section   = keikyo_interview_get_group( $post_id, 'message_section' );
			$final_cta_section = keikyo_interview_get_group( $post_id, 'final_cta_section' );


		$recommended_items = keikyo_interview_normalize_repeater(
			isset( $contents_section['contents_recommended_items'] ) ? $contents_section['contents_recommended_items'] : array(),
			array( 'recommended_text' )
		);
		$activity_chips = keikyo_interview_normalize_repeater(
			isset( $profile_section['student_activity_chips'] ) ? $profile_section['student_activity_chips'] : array(),
			array( 'activity_chip_label' )
		);
			$timeline_items = array();
			foreach ( isset( $timeline_section['timeline_items'] ) && is_array( $timeline_section['timeline_items'] ) ? $timeline_section['timeline_items'] : array() as $timeline_row ) {
				if ( ! is_array( $timeline_row ) ) {
					continue;
				}

				$has_timeline_content = '' !== keikyo_interview_get_nested_value( $timeline_row, 'timeline_keyword', '' )
					|| '' !== keikyo_interview_get_nested_value( $timeline_row, 'timeline_period', '' )
					|| '' !== keikyo_interview_get_nested_value( $timeline_row, 'timeline_item_title', '' )
					|| '' !== keikyo_interview_get_nested_value( $timeline_row, 'timeline_item_body', '' );

				if ( $has_timeline_content ) {
					$timeline_items[] = $timeline_row;
				}
			}


		$key_points = array();
		foreach (
			array(
				array(
					'number' => '01',
					'title'  => keikyo_interview_get_nested_value( $key_points_group, 'key_point_1_title', '' ),
					'body'   => keikyo_interview_get_nested_value( $key_points_group, 'key_point_1_body', '' ),
				),
				array(
					'number' => '02',
					'title'  => keikyo_interview_get_nested_value( $key_points_group, 'key_point_2_title', '' ),
					'body'   => keikyo_interview_get_nested_value( $key_points_group, 'key_point_2_body', '' ),
				),
				array(
					'number' => '03',
					'title'  => keikyo_interview_get_nested_value( $key_points_group, 'key_point_3_title', '' ),
					'body'   => keikyo_interview_get_nested_value( $key_points_group, 'key_point_3_body', '' ),
				),
			) as $point
		) {
			if ( '' === trim( wp_strip_all_tags( (string) $point['title'] ) ) || '' === trim( wp_strip_all_tags( (string) $point['body'] ) ) ) {
				continue;
			}

			$key_points[] = $point;
		}

		$profile_detail_rows = array();
		foreach (
			array(
				array( 'label' => '出身高校', 'key' => 'student_school' ),
				array( 'label' => '合格大学・学部', 'key' => 'student_result' ),
				array( 'label' => '入試方式', 'key' => 'student_admission_type' ),
				array( 'label' => '第一志望', 'key' => 'student_first_choice' ),
				array( 'label' => '英語資格', 'key' => 'student_english_score' ),
				array( 'label' => '最終評定平均', 'key' => 'student_final_gpa' ),
				array( 'label' => '部活', 'key' => 'student_club' ),
				array( 'label' => '準備期間', 'key' => 'student_prep_period' ),
				array( 'label' => '評定平均', 'key' => 'student_gpa' ),
				array( 'label' => '併願戦略', 'key' => 'student_other_choices' ),
					array( 'label' => '３教科偏差値', 'key' => 'student_deviation_3' ),
					array( 'label' => '５教科偏差値', 'key' => 'student_deviation_5' ),

			) as $detail_row
		) {
			$detail_value = keikyo_interview_get_nested_value( $profile_section, $detail_row['key'], '' );
			if ( '' === trim( wp_strip_all_tags( (string) $detail_value ) ) ) {
				continue;
			}

			$profile_detail_rows[] = array(
				'label' => $detail_row['label'],
				'value' => $detail_value,
			);
		}

			$hero_display_title    = keikyo_interview_get_nested_value( $hero_section, 'hero_display_title', keikyo_interview_get_nested_value( $hero_section, 'hero_page_title', '' ) );
			$hero_display_subtitle = keikyo_interview_get_nested_value( $hero_section, 'hero_display_subtitle', '' );

			$hero_visible = '' !== trim( wp_strip_all_tags( (string) $hero_display_title ) )
				&& '' !== trim( wp_strip_all_tags( (string) $hero_display_subtitle ) )
				&& '' !== keikyo_interview_get_nested_value( $hero_section, 'hero_lead_text', '' )
				&& '' !== keikyo_interview_get_image_url( keikyo_interview_get_nested_value( $hero_section, 'hero_image', array() ), 'large' )
				&& '' !== keikyo_interview_get_nested_value( $hero_section, 'hero_info_school', '' )
				&& '' !== keikyo_interview_get_nested_value( $hero_section, 'hero_info_result', '' )
				&& '' !== keikyo_interview_get_nested_value( $hero_section, 'hero_info_admission_type', '' )
				&& '' !== keikyo_interview_get_nested_value( $hero_section, 'hero_info_period', '' );

		$contents_visible = '' !== keikyo_interview_get_nested_value( $contents_section, 'contents_story', '' )
			&& '' !== keikyo_interview_get_nested_value( $contents_section, 'contents_inquiry', '' )
			&& '' !== keikyo_interview_get_nested_value( $contents_section, 'contents_reason', '' )
			&& '' !== keikyo_interview_get_nested_value( $contents_section, 'contents_strategy', '' )
			&& ! empty( $recommended_items );

		$profile_visible = '' !== keikyo_interview_get_nested_value( $profile_section, 'student_name', '' )
			&& '' !== keikyo_interview_get_nested_value( $profile_section, 'student_name_kana', '' )
			&& '' !== keikyo_interview_get_nested_value( $profile_section, 'student_result', '' )
			&& '' !== keikyo_interview_get_nested_value( $profile_section, 'student_admission_type', '' )
			&& '' !== keikyo_interview_get_nested_value( $profile_section, 'student_quote', '' )
			&& '' !== keikyo_interview_get_image_url( keikyo_interview_get_nested_value( $profile_section, 'student_profile_image', array() ), 'large' );

			$message_visible = '' !== keikyo_interview_get_image_url( keikyo_interview_get_nested_value( $message_section, 'message_advisor_image', array() ), 'medium_large' )
				|| '' !== keikyo_interview_get_nested_value( $message_section, 'message_youtube_url', '' );

			$final_cta_visible = true;

			$sections_visibility = array(
				'hero'       => $hero_visible,
				'lead'       => $contents_visible,
				'key_points' => count( $key_points ) === 3,
				'profile'    => $profile_visible,
				'timeline'   => ! empty( $timeline_items ),
				'message'    => $message_visible,
				'final_cta'  => $final_cta_visible,
			);


			return array(
				'post_id'             => $post_id,
				'post'                => get_post( $post_id ),
				'hero_section'        => $hero_section,
				'contents_section'    => $contents_section,
				'lead_section'        => $contents_section,
				'key_points_section'  => $key_points_group,
				'key_success_factors' => $key_points_group,
				'profile_section'     => $profile_section,
				'timeline_section'    => $timeline_section,
				'message_section'     => $message_section,
				'final_cta_section'   => $final_cta_section,
				'key_points'          => $key_points,
				'recommended_items'   => $recommended_items,
				'timeline_items'      => $timeline_items,
				'activity_chips'      => $activity_chips,
				'profile_detail_rows' => $profile_detail_rows,
				'sections_visibility' => $sections_visibility,
			);

	}
}

if ( ! function_exists( 'keikyo_interview_get_nav_items' ) ) {
	function keikyo_interview_get_nav_items( $context ) {
		$items = array();

		$map = array(
			'lead'       => array( 'id' => 'contents', 'label' => 'Contents' ),
			'key_points' => array( 'id' => 'key-points', 'label' => 'Key Points' ),
			'profile'    => array( 'id' => 'profile', 'label' => 'Profile' ),
			'timeline'   => array( 'id' => 'timeline', 'label' => 'Story Timeline' ),
			'message'    => array( 'id' => 'message', 'label' => 'Message' ),
		);

		foreach ( $map as $key => $item ) {
			if ( ! empty( $context['sections_visibility'][ $key ] ) ) {
				$items[] = $item;
			}
		}

		$items[] = array(
			'label'  => '総合型選抜合格ナビ',
			'url'    => 'https://www.keikyo-seminar.jp/archives/category/navigation',
			'target' => '_blank',
			'rel'    => 'noopener noreferrer',
		);

		return $items;
	}
}


if ( ! function_exists( 'keikyo_get_consultation_url' ) ) {
	function keikyo_get_consultation_url() {
		return 'https://lp.keikyo-seminar.jp/main01/';
	}
}

if ( ! function_exists( 'keikyo_interview_should_exclude_common_shell' ) ) {
	function keikyo_interview_should_exclude_common_shell() {
		if ( is_page( array( 'about', 'performance', 'diagnosis' ) ) ) {
			return true;
		}

		if ( is_page() ) {
			$template_slug = get_page_template_slug( get_queried_object_id() );

			if ( ! empty( $template_slug ) ) {
				return true;
			}
		}

		return false;
	}
}

if ( ! function_exists( 'keikyo_interview_should_override_theme_shell' ) ) {
	function keikyo_interview_should_override_theme_shell() {
		if ( is_admin() || is_feed() || is_embed() || is_search() || is_404() ) {
			return false;
		}

		if ( function_exists( 'wp_doing_ajax' ) && wp_doing_ajax() ) {
			return false;
		}

		if ( keikyo_interview_should_exclude_common_shell() ) {
			return false;
		}

		if ( is_front_page() || is_home() ) {
			return true;
		}

		if ( is_singular( 'interview' ) ) {
			return false;
		}

		if ( is_singular( array( 'page', 'post' ) ) ) {
			return true;
		}

		return keikyo_interview_is_archive_context();
	}
}

if ( ! function_exists( 'keikyo_should_use_common_shell' ) ) {
	function keikyo_should_use_common_shell() {
		return keikyo_interview_should_override_theme_shell();
	}
}

if ( ! function_exists( 'keikyo_interview_should_replace_root_shell' ) ) {
	function keikyo_interview_should_replace_root_shell() {
		if ( ! keikyo_interview_should_override_theme_shell() ) {
			return false;
		}

		if ( is_singular( array( 'page', 'post' ) ) ) {
			return false;
		}

		return true;
	}
}

if ( ! function_exists( 'keikyo_interview_should_inject_common_shell' ) ) {
	function keikyo_interview_should_inject_common_shell() {
		if ( ! keikyo_interview_should_override_theme_shell() ) {
			return false;
		}

		return is_singular( array( 'page', 'post' ) );
	}
}

if ( ! function_exists( 'keikyo_interview_render_injected_shell_header' ) ) {
	function keikyo_interview_render_injected_shell_header() {
		if ( ! keikyo_interview_should_inject_common_shell() ) {
			return;
		}

		get_template_part(
			'template-parts/interview/header',
			null,
			array(
				'context'   => array(
					'is_archive' => false,
					'is_home'    => is_home(),
					'is_front'   => is_front_page(),
				),
				'nav_items' => keikyo_interview_get_archive_nav_items(),
			)
		);
	}
}
add_action( 'wp_body_open', 'keikyo_interview_render_injected_shell_header', 20 );

if ( ! function_exists( 'keikyo_interview_render_injected_shell_footer' ) ) {
	function keikyo_interview_render_injected_shell_footer() {
		if ( ! keikyo_interview_should_inject_common_shell() ) {
			return;
		}

		get_template_part(
			'template-parts/interview/footer',
			null,
			array(
				'context' => array(
					'is_archive' => false,
					'is_home'    => is_home(),
					'is_front'   => is_front_page(),
				),
			)
		);
	}
}
add_action( 'wp_footer', 'keikyo_interview_render_injected_shell_footer', 5 );

if ( ! function_exists( 'keikyo_common_shell_body_class' ) ) {
	function keikyo_common_shell_body_class( $classes ) {
		if ( function_exists( 'keikyo_should_use_common_shell' ) && keikyo_should_use_common_shell() ) {
			$classes[] = 'keikyo-common-shell-active';
		}

		return array_values( array_unique( $classes ) );
	}
}
add_filter( 'body_class', 'keikyo_common_shell_body_class' );

if ( ! function_exists( 'keikyo_interview_is_archive_context' ) ) {
	function keikyo_interview_is_archive_context() {
		if ( is_post_type_archive( 'interview' ) || is_tax( array( 'interview_category', 'interview_university', 'interview_admission_type' ) ) ) {
			return true;
		}

		if ( is_category() || is_tag() || is_author() || is_date() ) {
			return true;
		}

		if ( is_archive() ) {
			$post_types = get_query_var( 'post_type' );

			if ( empty( $post_types ) ) {
				return true;
			}

			if ( is_string( $post_types ) ) {
				$post_types = array( $post_types );
			}

			if ( is_array( $post_types ) ) {
				return in_array( 'interview', $post_types, true ) || in_array( 'post', $post_types, true );
			}
		}

		return false;
	}
}

if ( ! function_exists( 'keikyo_should_enqueue_common_shell_css' ) ) {
	function keikyo_should_enqueue_common_shell_css() {
		return keikyo_should_use_common_shell();
	}
}

if ( ! function_exists( 'keikyo_interview_enqueue_assets' ) ) {
	function keikyo_interview_enqueue_assets() {
		if ( keikyo_should_enqueue_common_shell_css() ) {
			$shell_css_file = trailingslashit( get_stylesheet_directory() ) . 'css/keikyo-common-shell.css';
			$shell_css_uri  = trailingslashit( get_stylesheet_directory_uri() ) . 'css/keikyo-common-shell.css';
			$shell_version  = file_exists( $shell_css_file ) ? (string) filemtime( $shell_css_file ) : '20260406';

			wp_enqueue_style( 'keikyo-common-shell-style', $shell_css_uri, array( 'keikyo-components' ), $shell_version );
		}

		$should_load_interview_assets = is_singular( 'interview' ) || keikyo_should_use_common_shell();

		if ( ! $should_load_interview_assets ) {
			return;
		}

		$css_file = trailingslashit( get_stylesheet_directory() ) . 'css/interview.css';
		$css_uri  = trailingslashit( get_stylesheet_directory_uri() ) . 'css/interview.css';
		$version  = file_exists( $css_file ) ? (string) filemtime( $css_file ) : '20260401';

		wp_enqueue_style( 'keikyo-interview-style', $css_uri, array( 'keikyo-components' ), $version );

		$inline_css = <<<'CSS'
.keikyo-interview-profile .keikyo-interview-profile__figure {
  width: 100% !important;
  max-width: 560px !important;
}

.keikyo-interview-profile .keikyo-interview-profile__image {
  width: 100% !important;
  height: auto !important;
  aspect-ratio: auto !important;
  object-fit: contain !important;
  object-position: center top !important;
  background: #efe8dd !important;
}

.keikyo-interview-final-cta .keikyo-interview-final-cta__eyebrow,
.keikyo-interview-final-cta .keikyo-interview-final-cta__note {
  display: block !important;
  margin: 0 auto !important;
  padding: 0 !important;
  background: none !important;
  color: rgba(255, 255, 255, 0.76) !important;
}

.keikyo-interview-final-cta .keikyo-interview-final-cta__eyebrow {
  margin-bottom: 18px !important;
  color: #c83b55 !important;
}

.keikyo-interview-final-cta .keikyo-interview-final-cta__title {
  display: block !important;
  width: 100% !important;
  max-width: none !important;
  margin: 0 !important;
  padding: 0 !important;
  background: none !important;
  color: #ffffff !important;
  font-size: clamp(2.6rem, 4.1vw, 4rem) !important;
  line-height: 1.26 !important;
}

.keikyo-interview-final-cta .keikyo-interview-final-cta__body {
  max-width: 640px !important;
  margin: 22px auto 0 !important;
}

.keikyo-interview-final-cta .keikyo-interview-final-cta__body p {
  display: block !important;
  margin: 0 !important;
  padding: 0 !important;
  background: none !important;
  color: rgba(255, 255, 255, 0.88) !important;
  font-size: 1.08rem !important;
  line-height: 2.02 !important;
}

.keikyo-interview-final-cta .keikyo-interview-final-cta__note {
  margin-top: 18px !important;
}


@media (max-width: 780px) {
  .keikyo-interview-final-cta .keikyo-interview-final-cta__title {
    font-size: 2rem !important;
  }
}
CSS;

		wp_add_inline_style( 'keikyo-interview-style', $inline_css );

		$inline_js = <<<'JS'
document.addEventListener('DOMContentLoaded', function () {
  var header = document.querySelector('.keikyo-interview-header');
  if (!header) {
    return;
  }

  var toggle = header.querySelector('.keikyo-interview-header__menu-toggle');
  var panel = header.querySelector('.keikyo-interview-header__mobile-panel');
  var closeButton = header.querySelector('.keikyo-interview-header__mobile-close');

  if (!toggle || !panel) {
    return;
  }

  var setOpenState = function (isOpen) {
    toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    header.classList.toggle('is-menu-open', isOpen);
    if (isOpen) {
      panel.removeAttribute('hidden');
      document.documentElement.classList.add('keikyo-interview-menu-open');
      document.body.classList.add('keikyo-interview-menu-open');
    } else {
      panel.setAttribute('hidden', 'hidden');
      document.documentElement.classList.remove('keikyo-interview-menu-open');
      document.body.classList.remove('keikyo-interview-menu-open');
    }
  };

  setOpenState(false);

  toggle.addEventListener('click', function () {
    setOpenState(toggle.getAttribute('aria-expanded') !== 'true');
  });

  if (closeButton) {
    closeButton.addEventListener('click', function () {
      setOpenState(false);
    });
  }

  panel.addEventListener('click', function (event) {
    if (event.target === panel) {
      setOpenState(false);
    }
  });

  panel.querySelectorAll('a').forEach(function (link) {
    link.addEventListener('click', function () {
      setOpenState(false);
    });
  });

  document.addEventListener('keydown', function (event) {
    if (event.key === 'Escape') {
      setOpenState(false);
    }
  });
});
JS;
		wp_register_script( 'keikyo-interview-script', '', array(), $version, true );
		wp_enqueue_script( 'keikyo-interview-script' );
		wp_add_inline_script( 'keikyo-interview-script', $inline_js );
	}
}
add_action( 'wp_enqueue_scripts', 'keikyo_interview_enqueue_assets' );

if ( ! function_exists( 'keikyo_interview_get_archive_nav_items' ) ) {
	function keikyo_interview_get_archive_nav_items() {
		return array(
			array(
				'label' => '慶教ゼミナールとは？',
				'url'   => home_url( '/about/' ),
			),
			array(
				'label' => '合格実績',
				'url'   => home_url( '/performance/' ),
			),
			array(
				'label' => '合格者対談',
				'url'   => home_url( '/archives/tag/interview-with-successful-candidates' ),
			),
			array(
				'label'  => '総合型選抜合格ナビ',
				'url'    => 'https://www.keikyo-seminar.jp/archives/category/navigation',
				'target' => '_blank',
				'rel'    => 'noopener noreferrer',
			),
		);
	}
}

if ( ! function_exists( 'keikyo_interview_render_archive_header' ) ) {
	function keikyo_interview_render_archive_header() {
		if ( ! keikyo_interview_is_archive_context() || is_singular( 'interview' ) || keikyo_should_use_common_shell() ) {
			return;
		}

		get_template_part(
			'template-parts/interview/header',
			null,
			array(
				'context'   => array(
					'is_archive' => true,
				),
				'nav_items' => keikyo_interview_get_archive_nav_items(),
			)
		);
	}
}
add_action( 'wp_body_open', 'keikyo_interview_render_archive_header', 20 );

if ( ! function_exists( 'keikyo_interview_render_archive_footer' ) ) {
	function keikyo_interview_render_archive_footer() {
		if ( ! keikyo_interview_is_archive_context() || is_singular( 'interview' ) || keikyo_should_use_common_shell() ) {
			return;
		}

		get_template_part(
			'template-parts/interview/footer',
			null,
			array(
				'context' => array(
					'is_archive' => true,
				),
			)
		);
	}
}
add_action( 'wp_footer', 'keikyo_interview_render_archive_footer', 5 );

if ( ! function_exists( 'keikyo_interview_get_publish_date' ) ) {
	function keikyo_interview_get_publish_date( $context ) {
		return get_the_date( 'Y.m.d', $context['post_id'] );
	}
}

if ( ! function_exists( 'keikyo_interview_get_breadcrumb_items' ) ) {
	function keikyo_interview_get_breadcrumb_items( $context ) {
		$items   = array();
		$items[] = array(
			'label' => 'ホーム',
			'url'   => home_url( '/' ),
		);
		$items[] = array(
			'label' => '合格者対談',
			'url'   => home_url( '/archives/tag/interview-with-successful-candidates' ),
		);

		$items[] = array(
			'label' => get_the_title( $context['post_id'] ),
			'url'   => '',
		);

		return $items;
	}
}


if ( ! function_exists( 'keikyo_interview_normalize_plain_text' ) ) {
	function keikyo_interview_normalize_plain_text( $value ) {
		$value = wp_strip_all_tags( (string) $value );
		$value = preg_replace( '/[\r\n\t ]+/u', ' ', $value );

		return trim( (string) $value );
	}
}

if ( ! function_exists( 'keikyo_interview_trim_plain_text' ) ) {
	function keikyo_interview_trim_plain_text( $value, $limit = 160 ) {
		$value = keikyo_interview_normalize_plain_text( $value );

		if ( '' === $value ) {
			return '';
		}

		if ( function_exists( 'mb_strlen' ) && function_exists( 'mb_substr' ) && mb_strlen( $value, 'UTF-8' ) > $limit ) {
			return trim( mb_substr( $value, 0, $limit, 'UTF-8' ) );
		}

		return $value;
	}
}

if ( ! function_exists( 'keikyo_interview_get_seo_title' ) ) {
	function keikyo_interview_get_seo_title( $context, $with_site_name = false ) {
		$post_id   = isset( $context['post_id'] ) ? (int) $context['post_id'] : get_the_ID();
		$title     = keikyo_interview_normalize_plain_text( get_the_title( $post_id ) );
		$site_name = keikyo_interview_normalize_plain_text( get_bloginfo( 'name' ) );

		if ( ! $with_site_name || '' === $site_name || '' === $title ) {
			return $title;
		}

		$contains_site_name = function_exists( 'mb_strpos' )
			? false !== mb_strpos( $title, $site_name, 0, 'UTF-8' )
			: false !== strpos( $title, $site_name );

		return $contains_site_name ? $title : $title . ' | ' . $site_name;
	}
}

if ( ! function_exists( 'keikyo_interview_get_meta_description' ) ) {
	function keikyo_interview_get_meta_description( $context ) {
		$post_id = isset( $context['post_id'] ) ? (int) $context['post_id'] : get_the_ID();
		$post    = get_post( $post_id );
		$hero    = isset( $context['hero_section'] ) && is_array( $context['hero_section'] ) ? $context['hero_section'] : array();

		$candidates = array(
			isset( $hero['hero_description'] ) ? $hero['hero_description'] : '',
			$post instanceof WP_Post ? $post->post_excerpt : '',
			isset( $hero['hero_lead_text'] ) ? $hero['hero_lead_text'] : '',
			$post instanceof WP_Post ? $post->post_content : '',
		);

		foreach ( $candidates as $candidate ) {
			$description = keikyo_interview_trim_plain_text( $candidate, 160 );
			if ( '' !== $description ) {
				return $description;
			}
		}

		return '';
	}
}

if ( ! function_exists( 'keikyo_interview_get_canonical_url' ) ) {
	function keikyo_interview_get_canonical_url( $context ) {
		$post_id = isset( $context['post_id'] ) ? (int) $context['post_id'] : get_the_ID();
		$url     = get_permalink( $post_id );

		return $url ? $url : home_url( '/' );
	}
}

if ( ! function_exists( 'keikyo_interview_get_og_image_url' ) ) {
	function keikyo_interview_get_og_image_url( $context ) {
		$post_id         = isset( $context['post_id'] ) ? (int) $context['post_id'] : get_the_ID();
		$hero_section    = isset( $context['hero_section'] ) && is_array( $context['hero_section'] ) ? $context['hero_section'] : array();
		$profile_section = isset( $context['profile_section'] ) && is_array( $context['profile_section'] ) ? $context['profile_section'] : array();
		$message_section = isset( $context['message_section'] ) && is_array( $context['message_section'] ) ? $context['message_section'] : array();

		$candidates = array(
			get_the_post_thumbnail_url( $post_id, 'full' ),
			keikyo_interview_get_image_url( isset( $hero_section['hero_image'] ) ? $hero_section['hero_image'] : array(), 'full' ),
			keikyo_interview_get_image_url( isset( $profile_section['student_profile_image'] ) ? $profile_section['student_profile_image'] : array(), 'full' ),
			keikyo_interview_get_image_url( isset( $message_section['message_advisor_image'] ) ? $message_section['message_advisor_image'] : array(), 'full' ),
		);

		foreach ( $candidates as $candidate ) {
			if ( ! empty( $candidate ) ) {
				return $candidate;
			}
		}

		return '';
	}
}

if ( ! function_exists( 'keikyo_interview_get_og_image_alt' ) ) {
	function keikyo_interview_get_og_image_alt( $context ) {
		$post_id         = isset( $context['post_id'] ) ? (int) $context['post_id'] : get_the_ID();
		$hero_section    = isset( $context['hero_section'] ) && is_array( $context['hero_section'] ) ? $context['hero_section'] : array();
		$profile_section = isset( $context['profile_section'] ) && is_array( $context['profile_section'] ) ? $context['profile_section'] : array();
		$message_section = isset( $context['message_section'] ) && is_array( $context['message_section'] ) ? $context['message_section'] : array();
		$post_title      = keikyo_interview_get_seo_title( $context, false );
		$thumbnail_id    = get_post_thumbnail_id( $post_id );
		$thumbnail_alt   = $thumbnail_id ? keikyo_interview_normalize_plain_text( get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true ) ) : '';

		if ( '' !== $thumbnail_alt ) {
			return $thumbnail_alt;
		}

		if ( $thumbnail_id ) {
			$thumbnail_title = keikyo_interview_normalize_plain_text( get_the_title( $thumbnail_id ) );
			if ( '' !== $thumbnail_title ) {
				return $thumbnail_title;
			}
		}

		$hero_alt = keikyo_interview_get_image_alt(
			isset( $hero_section['hero_image'] ) ? $hero_section['hero_image'] : array(),
			'' !== $post_title ? $post_title . 'の合格者インタビュー写真' : '合格者インタビュー写真'
		);
		if ( '' !== keikyo_interview_normalize_plain_text( $hero_alt ) ) {
			return keikyo_interview_normalize_plain_text( $hero_alt );
		}

		$student_name = isset( $profile_section['student_name'] ) ? keikyo_interview_normalize_plain_text( $profile_section['student_name'] ) : '';
		$profile_alt  = keikyo_interview_get_image_alt(
			isset( $profile_section['student_profile_image'] ) ? $profile_section['student_profile_image'] : array(),
			'' !== $student_name ? $student_name . 'さんのプロフィール写真' : $post_title . 'のプロフィール写真'
		);
		if ( '' !== keikyo_interview_normalize_plain_text( $profile_alt ) ) {
			return keikyo_interview_normalize_plain_text( $profile_alt );
		}

		$advisor_alt = keikyo_interview_get_image_alt(
			isset( $message_section['message_advisor_image'] ) ? $message_section['message_advisor_image'] : array(),
			'慶教ゼミナール 塾長メッセージ写真'
		);

		return keikyo_interview_normalize_plain_text( $advisor_alt );
	}
}

if ( ! function_exists( 'keikyo_interview_get_article_keywords' ) ) {
	function keikyo_interview_get_article_keywords( $post_id ) {
		$terms = wp_get_post_terms(
			$post_id,
			array( 'post_tag', 'interview_category', 'interview_university', 'interview_admission_type' ),
			array( 'fields' => 'names' )
		);

		if ( is_wp_error( $terms ) || empty( $terms ) ) {
			return array();
		}

		return array_values( array_unique( array_filter( array_map( 'keikyo_interview_normalize_plain_text', $terms ) ) ) );
	}
}

if ( ! function_exists( 'keikyo_interview_get_publisher_schema' ) ) {
	function keikyo_interview_get_publisher_schema() {
		$publisher = array(
			'@type' => 'Organization',
			'name'  => keikyo_interview_normalize_plain_text( get_bloginfo( 'name' ) ),
			'url'   => home_url( '/' ),
		);

		$logo_url = '';

		if ( function_exists( 'has_custom_logo' ) && has_custom_logo() ) {
			$logo_id = (int) get_theme_mod( 'custom_logo' );
			if ( $logo_id ) {
				$logo_url = wp_get_attachment_image_url( $logo_id, 'full' );
			}
		}

		if ( '' === $logo_url ) {
			$site_icon_id = (int) get_option( 'site_icon' );
			if ( $site_icon_id ) {
				$logo_url = wp_get_attachment_image_url( $site_icon_id, 'full' );
			}
		}

		if ( $logo_url ) {
			$publisher['logo'] = array(
				'@type' => 'ImageObject',
				'url'   => $logo_url,
			);
		}

		return $publisher;
	}
}

if ( ! function_exists( 'keikyo_interview_get_article_schema' ) ) {
	function keikyo_interview_get_article_schema( $context ) {
		$post_id          = isset( $context['post_id'] ) ? (int) $context['post_id'] : get_the_ID();
		$canonical_url    = keikyo_interview_get_canonical_url( $context );
		$description      = keikyo_interview_get_meta_description( $context );
		$image_url        = keikyo_interview_get_og_image_url( $context );
		$image_alt        = keikyo_interview_get_og_image_alt( $context );
		$profile_section  = isset( $context['profile_section'] ) && is_array( $context['profile_section'] ) ? $context['profile_section'] : array();
		$hero_section     = isset( $context['hero_section'] ) && is_array( $context['hero_section'] ) ? $context['hero_section'] : array();
		$student_name     = isset( $profile_section['student_name'] ) ? keikyo_interview_normalize_plain_text( $profile_section['student_name'] ) : '';
		$admission_type   = isset( $profile_section['student_admission_type'] ) ? keikyo_interview_normalize_plain_text( $profile_section['student_admission_type'] ) : '';
		$accepted_result  = isset( $profile_section['student_result'] ) ? keikyo_interview_normalize_plain_text( $profile_section['student_result'] ) : '';
		$school_name      = isset( $hero_section['hero_info_school'] ) ? keikyo_interview_normalize_plain_text( $hero_section['hero_info_school'] ) : '';
		$post_author      = get_userdata( (int) get_post_field( 'post_author', $post_id ) );
		$author_name      = $post_author instanceof WP_User ? keikyo_interview_normalize_plain_text( $post_author->display_name ) : '';
		$article_keywords = keikyo_interview_get_article_keywords( $post_id );

		$schema = array(
			'@context'         => 'https://schema.org',
			'@type'            => 'Article',
			'mainEntityOfPage' => array(
				'@type' => 'WebPage',
				'@id'   => $canonical_url,
			),
			'headline'         => keikyo_interview_get_seo_title( $context, false ),
			'description'      => $description,
			'datePublished'    => get_post_time( 'c', false, $post_id ),
			'dateModified'     => get_post_modified_time( 'c', false, $post_id ),
			'inLanguage'       => get_bloginfo( 'language' ),
			'isAccessibleForFree' => true,
			'publisher'        => keikyo_interview_get_publisher_schema(),
		);

		if ( '' !== $author_name ) {
			$schema['author'] = array(
				'@type' => 'Person',
				'name'  => $author_name,
			);
		} else {
			$schema['author'] = keikyo_interview_get_publisher_schema();
		}

		if ( '' !== $image_url ) {
			$schema['image'] = array(
				'@type' => 'ImageObject',
				'url'   => $image_url,
				'name'  => $image_alt,
			);
			$schema['thumbnailUrl'] = $image_url;
		}

		if ( ! empty( $article_keywords ) ) {
			$schema['keywords'] = implode( ', ', $article_keywords );
		}

		$about_items = array_filter(
			array(
				$student_name,
				$accepted_result,
				$admission_type,
				$school_name,
			)
		);
		if ( ! empty( $about_items ) ) {
			$schema['about'] = array_values( $about_items );
		}

		return $schema;
	}
}

if ( ! function_exists( 'keikyo_interview_get_breadcrumb_schema' ) ) {
	function keikyo_interview_get_breadcrumb_schema( $context ) {
		$items         = keikyo_interview_get_breadcrumb_items( $context );
		$list_items    = array();
		$canonical_url = keikyo_interview_get_canonical_url( $context );

		foreach ( $items as $index => $item ) {
			$item_url = ! empty( $item['url'] ) ? esc_url_raw( $item['url'] ) : '';

			if ( '' === $item_url && $index === count( $items ) - 1 ) {
				$item_url = esc_url_raw( $canonical_url );
			}

			$list_items[] = array(
				'@type'    => 'ListItem',
				'position' => $index + 1,
				'name'     => isset( $item['label'] ) ? keikyo_interview_normalize_plain_text( $item['label'] ) : '',
				'item'     => $item_url,
			);
		}

		return array(
			'@context'        => 'https://schema.org',
			'@type'           => 'BreadcrumbList',
			'itemListElement' => $list_items,
		);
	}
}

if ( ! function_exists( 'keikyo_interview_disable_default_canonical_for_singular' ) ) {
	function keikyo_interview_disable_default_canonical_for_singular() {
		if ( is_singular( 'interview' ) ) {
			remove_action( 'wp_head', 'rel_canonical' );
		}
	}
}
add_action( 'wp', 'keikyo_interview_disable_default_canonical_for_singular' );

if ( ! function_exists( 'keikyo_interview_output_seo_meta' ) ) {
	function keikyo_interview_output_seo_meta() {
		if ( ! is_singular( 'interview' ) ) {
			return;
		}

		$context      = keikyo_interview_build_context( get_the_ID() );
		$title        = keikyo_interview_get_seo_title( $context, true );
		$description  = keikyo_interview_get_meta_description( $context );
		$canonical    = keikyo_interview_get_canonical_url( $context );
		$og_image     = keikyo_interview_get_og_image_url( $context );
		$og_image_alt = keikyo_interview_get_og_image_alt( $context );
			$site_name    = keikyo_interview_normalize_plain_text( get_bloginfo( 'name' ) );
			$locale       = str_replace( '-', '_', get_locale() );


		echo "\n" . '<!-- Interview SEO -->' . "\n";

		if ( '' !== $description ) {
			echo '<meta name="description" content="' . esc_attr( $description ) . '">' . "\n";
		}

		if ( '' !== $canonical ) {
			echo '<link rel="canonical" href="' . esc_url( $canonical ) . '">' . "\n";
		}

		if ( '' !== $title ) {
			echo '<meta property="og:title" content="' . esc_attr( $title ) . '">' . "\n";
			echo '<meta name="twitter:title" content="' . esc_attr( $title ) . '">' . "\n";
		}

		if ( '' !== $description ) {
			echo '<meta property="og:description" content="' . esc_attr( $description ) . '">' . "\n";
			echo '<meta name="twitter:description" content="' . esc_attr( $description ) . '">' . "\n";
		}

		echo '<meta property="og:type" content="article">' . "\n";
		echo '<meta name="twitter:card" content="summary_large_image">' . "\n";

		if ( '' !== $canonical ) {
			echo '<meta property="og:url" content="' . esc_url( $canonical ) . '">' . "\n";
		}

		if ( '' !== $site_name ) {
			echo '<meta property="og:site_name" content="' . esc_attr( $site_name ) . '">' . "\n";
		}

		if ( '' !== $locale ) {
			echo '<meta property="og:locale" content="' . esc_attr( $locale ) . '">' . "\n";
		}

		if ( '' !== $og_image ) {
			echo '<meta property="og:image" content="' . esc_url( $og_image ) . '">' . "\n";
			echo '<meta name="twitter:image" content="' . esc_url( $og_image ) . '">' . "\n";
			if ( '' !== $og_image_alt ) {
				echo '<meta property="og:image:alt" content="' . esc_attr( $og_image_alt ) . '">' . "\n";
				echo '<meta name="twitter:image:alt" content="' . esc_attr( $og_image_alt ) . '">' . "\n";
			}
		}
	}
}
add_action( 'wp_head', 'keikyo_interview_output_seo_meta', 1 );

if ( ! function_exists( 'keikyo_interview_output_structured_data' ) ) {
	function keikyo_interview_output_structured_data() {
		if ( ! is_singular( 'interview' ) ) {
			return;
		}

		$context = keikyo_interview_build_context( get_the_ID() );
		$data    = array(
			keikyo_interview_get_article_schema( $context ),
			keikyo_interview_get_breadcrumb_schema( $context ),
		);

		echo "\n" . '<script type="application/ld+json">' . wp_json_encode( $data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
	}
}
add_action( 'wp_head', 'keikyo_interview_output_structured_data', 20 );
