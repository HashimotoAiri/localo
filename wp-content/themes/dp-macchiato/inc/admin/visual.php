<?php
global $def_visual;
// Get values
extract($options);

//Preg Match Pattern
$strPattern	=	'/(\.gif|\.jpg|\.jpeg|\.png)$/';

// Tiny MCE settings
$wp_editor_setings = array(
				'wpautop' => false,
				'textarea_rows' => 5);


// Get images
$dp_theme_title_images = dp_get_uploaded_images("title");
$dp_theme_header_images = dp_get_uploaded_images("header");
$dp_theme_mb_header_images = dp_get_uploaded_images("header/mobile");
$dp_theme_bg_images = dp_get_uploaded_images("background");


// $js_jquery_ui = str_replace(array("\r\n","\r","\n","\t"), '', $js_jquery_ui);
echo $js_jquery_ui;
?>
<div class="wrap">
<div id="dp_custom">
<h2 class="dp_h2 icon-palette"><?php _e('DigiPress Visual Settings', 'DigiPress'); ?></h2>
<p class="ft11px"><?php echo DP_THEME_NAME . ' Ver.' . DP_OPTION_SPT_VERSION; ?></p>
<?php 
if ( get_option( DP_THEME_LICENSE_KEY_PHRASE.'_status' ) != 'valid' ) return;
dp_permission_check(); 
?>
<!--
========================================
アップロード
========================================
-->
<h3 class="dp_h3 icon-menu" id="upload">画像アップロード</h3>
<div class="dp_box" class="clearfix">
	<dl>
		<dt class="dp_set_title1 icon-bookmark">サイトタイトル画像 :</dt>
		<dd>
		<!-- Title Image Upload form Start -->
		<div id="imgUploadTitleBlock">
			<form action="#" method="post" enctype="multipart/form-data">
			<input type="hidden" name="max_file_size" value="512000" />
			<input type="hidden" name="target_dir" value="<?php echo DP_UPLOAD_DIR . '/title'; ?>" />
			<input type="file" name="dp_title_img" size="45" />
			<input type="submit" class="button" name="dp_upload_file_title_img" value="アップロード" />
			</form>
		</div>
		<!-- Title Image Upload form End -->
		
		<div class="slide-title icon-attention"><?php _e('Note...', 'DigiPress'); ?></div>
		<div class="slide-content">
		※アップロード対応フォーマット : <span class="red">*.jpg, *.png, *.gif, *.jpeg</span><br />
		※アップロードファイルサイズの上限 : <span class="red">500KB</span><br />
		※<span class="red">PHPがセーフモード</span>の場合、「<span class="red"><?php echo DP_UPLOAD_DIR; ?>/title</span>」フォルダのパーミッションを「<span class="red">777</span>」にしてください。<br />
		※画像サイズに制限はありませんが、どのような画像サイズでも<span class="red">高さが最大45ピクセルとしてリサイズ</span>されます。
		</div>
		</dd>

		<dt class="dp_set_title1 icon-bookmark">ヘッダー画像 :</dt>
		<dd>
			<table>
				<tr>
					<td>PCテーマ用 : </td>
					<td>
						<form action="#" method="post" enctype="multipart/form-data">
						<input type="hidden" name="max_file_size" value="2480000" />
						<input type="hidden" name="target_dir" value="<?php echo DP_UPLOAD_DIR . '/header'; ?>" />
						<input type="file" name="dp_header_img" size="45" />
						<input type="submit" class="button" name="dp_upload_file_hd" value="アップロード" />
						</form>
					</td>
				</tr>
				<tr>
					<td>モバイルテーマ用 : </td>
					<td>
						<form action="#" method="post" enctype="multipart/form-data">
						<input type="hidden" name="max_file_size" value="1240000" />
						<input type="hidden" name="target_dir" value="<?php echo DP_UPLOAD_DIR . '/header/mobile'; ?>" />
						<input type="file" name="dp_header_img_mobile" size="45" />
						<input type="submit" class="button" name="dp_upload_file_hd_mobile" value="アップロード" />
						</form>
					</td>
				</tr>
			</table>
			
			<div class="slide-title icon-attention"><?php _e('Note...', 'DigiPress'); ?></div>
			<div class="slide-content">
			※アップロード対応フォーマット : <span class="red">*.jpg, *.png, *.gif, *.jpeg</span><br />
			※アップロードファイルサイズの上限 : <span class="red">2MB(モバイル用は1MB)</span><br />
			※<span class="red">PHPがセーフモード</span>の場合、「<span class="red"><?php echo DP_UPLOAD_DIR; ?>/header</span>」フォルダのパーミッションを「<span class="red">777</span>」にしてください。<br />
			※フルスクリーンで表示されるため、アップロードする画像は<span class="red">極力圧縮してファイルサイズを最軽量化</span>することを強く推奨します。
			</div>
		</dd>
	</dl>
	<div class="mg20px-top mg10px-l mg20px-btm clearfix">
	<p class="fl-l mg20px-r"><a href="?page=digipress_edit_images" class="button open_trim_menu">画像のトリミング／リサイズ</a></p>
	<p class="fl-l"><a href="?page=digipress_delete_file" class="button open_delete_menu">アップロード画像の削除</a></p>
	</div>
</div>


<div class="mg10px-top mg20px-btm"><input class="button close_all" type="button" name="close_all" value=" <?php _e('Close All', 'DigiPress'); ?>" /></div>

<!--
========================================
テーマ選択ここから
========================================
-->
<form method="post" action="#" name="dp_form" enctype="multipart/form-data">
<h3 class="dp_h3 icon-menu">表示カラム数／サイドバー位置設定</h3>
<div class="dp_box">
		<dl>
			<!-- サイドバーのタイプ -->
			<dt class="dp_set_title1 icon-bookmark">カラムタイプ :</dt>
				<dd class="clearfix">
				<div class="mg45px-r fl-l">
					<div class="clearfix pd5px-btm">
					<img src="<?php echo DP_THEME_URI; ?>/inc/admin/img/1column.png" />
					</div>
				<input name="dp_column" id="dp_column1" type="radio" value="1" <?php if($options['dp_column'] === "1") echo "checked"; ?> /><label for="dp_column1"> 1カラム</label>
				</div>
				
				<div class="clearfix">
					<div class="fl-l">
						<div class="clearfix pd10px-btm" id="sidebar_img_block">
						<img src="<?php echo DP_THEME_URI; ?>/inc/admin/img/2column_right_sidebar.png" id="sidebar_r_img" class="hiddenImg" />
						<img src="<?php echo DP_THEME_URI; ?>/inc/admin/img/2column_left_sidebar.png" id="sidebar_l_img" class="hiddenImg" />
						</div>
						<div class="pd14px-top">
							<input name="dp_column" id="dp_column2" type="radio" value="2" <?php if($options['dp_column'] === "2") echo "checked"; ?>  /><label for="dp_column2" class="mg12px-r"> 2カラム</label>
							<div class="mg10px-l mg10px-top">
								<select name="dp_theme_sidebar" id="dp_theme_sidebar" size="1" class="mg40px-up" style="width:120px;">
								<option value="left" <?php if($options['dp_theme_sidebar'] == 'left') echo "selected=\"selected\""; ?>>左サイドバー</option>
								<option value="right" <?php if($options['dp_theme_sidebar'] == 'right') echo "selected=\"selected\""; ?>>右サイドバー</option>
								</select>
							</div>
						</div>
				</div>

				</div>
				<input name="dp_1column_only_top" class="cl-r" id="dp_1column_only_top" type="checkbox" value="true" <?php if($options['dp_1column_only_top']) echo "checked"; ?> /><label for="dp_1column_only_top">トップページのみ1カラム</label>
				</dd>
		</dl>
<!-- 保存ボタン -->
<div class="mg20px-l mg20px-btm">
<input class="button button-primary" type="submit" name="dp_save_visual" value="<?php _e(' Save ', 'DigiPress'); ?>" />
</div>
</div>
<!--
========================================
テーマ選択ここまで
========================================
-->

<div class="mg10px-top mg20px-btm"><input class="button close_all" type="button" name="close_all" value=" <?php _e('Close All', 'DigiPress'); ?>" /></div>


<h3 class="dp_h3 icon-menu">サイト一般表示設定</h3>
<div class="dp_box">
		<dl>
			<dt class="dp_set_title1 icon-bookmark">カラー設定 :</dt>
				<dd class="mg20px-btm">
					<table class="dp_table1">
						<tr>
							<td>キーカラー :</td>
							<td>
								<input type="text" name="accent_color" value="<?php echo $accent_color; ?>" class="dp-color-field" data-default-color="<?php echo $def_visual['accent_color']; ?>" />
							</td>
						</tr>
						<tr>
							<td>カテゴリー別イメージカラー :</td>
							<td>
								<div class="box-c pd30px-r">
									<ul class="dp_ul" style="height:250px;overflow-y:scroll">
<?php 
						$args = array(
							'hide_empty' => false,
							'orderby' 	=> 'id');
						$cats = get_categories($args);
						foreach ($cats as $key => $cat) {
							echo '<li><label>'.$cat->cat_name.' : <input type="text" name="cat_colors[]" class="dp-color-field" value="'.$options['cat_colors'][$key].'" data-default-color="'.$options['base_link_color'].'" /></label><input type="hidden" name="cat_ids[]" value="'.$cat->term_id.'" /></li>';
						}
?>
									</ul>
								</div>
							</td>
							</tr>
					</table>
					
					<div class="cl-a slide-title icon-attention mg12px-top"><?php _e('Note...', 'DigiPress'); ?></div>
					<div class="slide-content">
					※キーカラーとは、グローバルメニュー、ページナビゲーション、サイトバータイトル、見出しタグのアクセントなど、サイト内の様々なポイントで利用されるサイト全体のキーカラーを指定します。
					</div>
				</dd>
		</dl>
<!-- 保存ボタン -->
<div class="mg20px-l mg20px-btm">
<input class="button button-primary" type="submit" name="dp_save_visual" value="<?php _e(' Save ', 'DigiPress'); ?>" />
</div>
</div>

<div class="mg10px-top mg20px-btm"><input class="button close_all" type="button" name="close_all" value=" <?php _e('Close All', 'DigiPress'); ?>" /></div>

<!--
========================================
ヘッダーデザインカスタマイズここから
========================================
-->
<h3 class="dp_h3 icon-menu">ヘッダーバーエリア設定</h3>
<div class="dp_box">
	<dl>	
		<dt class="dp_set_title1 icon-bookmark">サイトメインタイトル表示設定</dt>
			<dd class="clearfix">
				<div class="sample_img icon-camera mg25px-l">表示サンプル
				<img src="<?php echo DP_THEME_URI ?>/inc/admin/img/h1_title.png" />
				</div>
				
				<div class="clearfix mg20px-btm mg15px-top mg20px-l">
					<div class="mg20px-btm">
	  				<input name="h1title_as_what" id="h1title_as_what1" type="radio" value="text" <?php if($options['h1title_as_what'] == 'text') echo "checked"; ?> />
	  				<label for="h1title_as_what1" id="h1title_as_what1" class="12px b">
	  				サイトタイトルをテキストで表示
	  				</label>
	  				</div>
				
					<input name="h1title_as_what" id="h1title_as_what2" type="radio" value="image" <?php if($options['h1title_as_what'] == 'image') echo "checked"; ?> />
					<label for="h1title_as_what2" id="h1title_as_what2" class="12px b">
					サイトタイトルを画像で表示
					</label>
					
					<div id="h1title_as_image" class="box-c">
						<h3 class="dp_set_title2 pd24px-l">
						<a href="#upload" id="title_img_upload">タイトル画像をアップロード</a>
						</h3>
							
							<div class="mg25px-l mg25px-btm">
							アップロードメニューにジャンプします。<br />
							サイトタイトルのリンクを任意の画像で表示する場合は、こちらよりアップロードを行います。
							</div>
							
						<!-- タイトル画像一覧・選択 -->
						<div class="mg25px-btm">
							<h3 class="dp_set_title2 pd24px-l">タイトル画像選択 (トップページ用) :</h3>
								<div class="mg40px-l mg25px-btm">
								<div class="imgHover">
							<?php
								if ( !empty($dp_theme_title_images) ) {
									echo '<ul class="clearfix thumb">';
									foreach ($dp_theme_title_images[0] as $key => $current_image) {
										//Current Image
										if ($options['dp_title_img'] === $current_image) {
											$chk	= " checked";
										} else {
											$chk	= "";
										}
										echo '<li><div class="clearfix pd10px-btm">
											<img src="' . $current_image . '"  class="thumbImg" />
											<img src="' . $current_image . '" class="hiddenImg" />
											</div>
											<input name="dp_title_img" id="dp_title_img'.$key.'" type="radio" value="' . $current_image . '"' . $chk . ' />
											<label for="dp_title_img'.$key.'">' . $dp_theme_title_images[1][$key] . '</label></li>';
									}
									echo '</ul>';
								} else {
									echo '<p class="red">アップロードされたイメージはまだありません。</p>';
								}
							?>
								</div>
								</div>
						</div>

						<!-- タイトル画像一覧・選択 -->
						<div class="mg25px-btm">
							<h3 class="dp_set_title2 pd24px-l">タイトル画像選択 (モバイル用) :</h3>
								<div class="mg40px-l mg25px-btm">
								<div class="imgHover">
							<?php

								if ( !empty($dp_theme_title_images) ) {
									echo '<ul class="clearfix thumb">';
									foreach ($dp_theme_title_images[0] as $key => $current_image) {
										//Current Image
										if ($options['dp_title_img_mobile'] === $current_image) {
											$chk	= " checked";
										} else {
											$chk	= "";
										}
										echo '<li><div class="clearfix pd10px-btm">
											<img src="' . $current_image . '"  class="thumbImg" />
											<img src="' . $current_image . '" class="hiddenImg" />
											</div>
											<input name="dp_title_img_mobile" id="dp_title_img_mobile'.$key.'" type="radio" value="' . $current_image . '"' . $chk . ' />
											<label for="dp_title_img_mobile'.$key.'">' . $dp_theme_title_images[1][$key] . '</label></li>';
									}
									echo '</ul>';
								} else {
									echo '<p class="red">アップロードされたイメージはまだありません。</p>';
								}
							?>
								</div>
								</div>
						</div>
					<div class="slide-title icon-attention"><?php _e('Note...', 'DigiPress'); ?></div>
					<div class="slide-content">
					※タイトル用の画像のサイズは「<span class="red b">高精度ディスプレイ対策</span>」(実表示の2倍サイズ)を前提としたサイズを用意されることを推奨します(表示上は45ピクセル(縦)を基準としてリサイズされます)。
					</div>
				 </div>
			</div>
			</dd>

		<dt class="dp_set_title1 icon-bookmark">ヘッダーバーエリアカラー設定</dt>
	   	<dd class="clearfix">
			<div class="sample_img icon-camera mg25px-l">表示サンプル
			<img src="<?php echo DP_THEME_URI ?>/inc/admin/img/floating_menu_color.png" /></div>

			<div class="mg25px-l mg25px-btm">
			<table class="tbl-picker">
				<tr>
					<td>背景カラー :</td>
					<td>
						<input type="text" name="header_menu_bgcolor" value="<?php echo $header_menu_bgcolor; ?>" class="dp-color-field" data-default-color="<?php echo $def_visual['header_menu_bgcolor']; ?>" />
					</td>
				</tr>
				<tr>
					<td>フォント／リンクカラー :</td>
					<td>
						<input type="text" name="header_menu_link_color" value="<?php echo $header_menu_link_color; ?>" class="dp-color-field" data-default-color="<?php echo $def_visual['header_menu_link_color']; ?>" />
					</td>
				</tr>
				<tr>
					<td>リンクカラー(ホバー時) :</td>
					<td>
						<input type="text" name="header_menu_link_hover_color" value="<?php echo $header_menu_link_hover_color; ?>" class="dp-color-field" data-default-color="<?php echo $def_visual['header_menu_link_hover_color']; ?>" />
					</td>
				</tr>
			</table>

				<div class="slide-title icon-attention mg18px-top"><?php _e('Note...', 'DigiPress'); ?></div>
				<div class="slide-content">
				※<span class="red">テーマ標準の値に戻す場合</span>は、<span class="red">「デフォルト」ボタン</span>をクリックしてください。
				</div>
			</div>
			</dd>
	</dl>
<!-- 保存ボタン -->
<div class="mg20px-l mg20px-btm">
<input class="button button-primary" type="submit" name="dp_save_visual" value="<?php _e(' Save ', 'DigiPress'); ?>" />
</div>
</div>
<!--
========================================
ヘッダーデザインカスタマイズここまで
========================================
-->

<div class="mg10px-top mg20px-btm"><input class="button close_all" type="button" name="close_all" value=" <?php _e('Close All', 'DigiPress'); ?>" /></div>


<!--
========================================
背景カスタマイズここから
========================================
-->
<h3 class="dp_h3 icon-menu">トップページヘッダーエリアコンテンツ設定</h3>
<div class="dp_box" id="bg_custom">
	<dl>
		<dt class="dp_set_title1 icon-bookmark">ヘッダー画像／スライド設定 :</dt>
			<dd>
			<div class="sample_img icon-camera">対象エリア
			<img src="<?php echo DP_THEME_URI ?>/inc/admin/img/header_content_area.png" />
			</div>

			<h3 class="dp_set_title2">トップページ専用設定</h3>
				<div class="mg15px-l mg20px-btm">
					<div class="mg10px-btm">
					<input name="dp_header_content_type" id="dp_header_content_type_none" type="radio" value="none" <?php if ($options['dp_header_content_type'] == "none") echo "checked"; ?> />
					<label for="dp_header_content_type_none" class="mg20px-r b">何も表示しない</label>
					</div>

					<div class="mg10px-btm">
					<input name="dp_header_content_type" id="dp_header_content_type1" type="radio" value="1" <?php if($options['dp_header_content_type'] == 1 ) echo "checked"; ?> />
					<label for="dp_header_content_type1" class="mg20px-r b">ヘッダー画像の静止画表示</label>
					</div>

					<div id="header_banner_settings" class="mg20px-l">
						<div class="box-c">
						<h3 class="dp_set_title2">
						<a href="#upload" id="header_img_upload">ヘッダー画像をアップロード</a>
						</h3>
						
						<div class="mg25px-l mg25px-btm">
						アップロードメニューにジャンプします。<br />
						オリジナルのヘッダー画像を使用する場合は、こちらよりアップロードを行います。
						</div>

						<!-- ヘッダー画像一覧・選択 -->
						<h3 class="dp_set_title2">ヘッダー画像選択 :</h3>
							<div class="mg25px-l mg25px-btm">トップページヘッダー画像、またはスライドショーの有無を選択できます。
								<div class="imgHover">
<?php
					if ( !empty($dp_theme_header_images) ) {
						echo '<ul class="clearfix thumb">';
						foreach ($dp_theme_header_images[0] as $key => $current_image) {
							//Current Image
							if ($options['dp_header_img'] === $current_image) {
								$chk	= " checked";
							} else {
								$chk	= "";
							}
							echo '<li><div class="clearfix pd10px-btm">
								<img src="' . $current_image . '"  class="thumbBannerImg_crop" />
								<img src="' . $current_image . '" class="hiddenImg" />
								</div>
								<input name="dp_header_img" id="dp_header_img'.$key.'" type="radio" value="' . $current_image . '"' . $chk . ' />
								<label for="dp_header_img'.$key.'">' . $dp_theme_header_images[1][$key] . '</label></li>';
						}
						echo '</ul>';
					
						$chkRandom = "";
						$chkNothing = "";
						if ($options['dp_header_img'] == 'random') {
							$chkRandom	= " checked='checked'";
						} else if (($options['dp_header_img'] == '') || ($options['dp_header_img'] == 'none') ) {
							$chkNothing	= " checked='checked'";
						}
						echo '</ul>';
						echo '<ul class="mg30px-top clearfix">'.
							 '<li class="fl-l"><input name="dp_header_img" id="dp_header_img_random" type="radio" value="random" '.$chkRandom.' /><span class="ft12px b pd15px-r"><label for="dp_header_img_random">ランダム表示</label></span></li>
							<li class="fl-l"><input name="dp_header_img" id="dp_header_img_none" type="radio" value="none" '.$chkNothing.' /><label for="dp_header_img_none"> なし(テーマ既定画像)</label></li></ul>';
					} else {
						echo '<p class="red">アップロードされたイメージはまだありません。</p>';
					}
				?>	
							</div>
						</div>
					</div>
				</div>
		
		
				<div class="clearfix mg10px-btm">
					<input name="dp_header_content_type" id="dp_header_content_type2" type="radio" value="2" <?php if ( $options['dp_header_content_type'] == 2 ) echo "checked"; ?> />
					<label for="dp_header_content_type2" class="mg20px-r b">スライドショー</label>
					
					<div id="slideshow_settings" class="mg20px-l">
						<div class="box-c">
							<div class="clearfix">
								<table class="tbl-picker pd12px-top dp_table1">
									<tr>
										<td style="width:180px;">表示対象 : </td>
										<td>
											<select name="dp_slideshow_target" id="dp_slideshow_target" size="1" style="width:180px;">
												<option value='header_img' <?php if ($options['dp_slideshow_target'] == 'header_img') echo "selected=\"selected\""; ?>>ヘッダー画像</option>
												<option value='post' <?php if ($options['dp_slideshow_target'] == 'post') echo "selected=\"selected\""; ?>>指定記事</option>
												<option value='page' <?php if ($options['dp_slideshow_target'] == 'page') echo "selected=\"selected\""; ?>>指定固定ページ</option>
											</select>
										</td>
									</tr>

									<tr id="dp_slideshow_max_num_div">
										<td>最大表示数 : </td>
										<td>
											<select name="dp_number_of_slideshow" id="dp_number_of_slideshow" size="1" style="width:90px;">
											<option value='3' <?php if($options['dp_number_of_slideshow'] == 3) echo "selected=\"selected\""; ?>>～3件</option>
											<option value='4' <?php if($options['dp_number_of_slideshow'] == 4) echo "selected=\"selected\""; ?>>～4件</option>
											<option value='5' <?php if($options['dp_number_of_slideshow'] == 5) echo "selected=\"selected\""; ?>>～5件</option>
											<option value='6' <?php if($options['dp_number_of_slideshow'] == 6) echo "selected=\"selected\""; ?>>～6件</option>
											<option value="7" <?php if($options['dp_number_of_slideshow'] == 7) echo "selected=\"selected\""; ?>>～7件</option>
											<option value='8' <?php if($options['dp_number_of_slideshow'] == 8) echo "selected=\"selected\""; ?>>～8件</option>
											<option value="9" <?php if($options['dp_number_of_slideshow'] == 9) echo "selected=\"selected\""; ?>>～9件</option>
											<option value="10" <?php if($options['dp_number_of_slideshow'] == 10 ) echo "selected=\"selected\""; ?>>～10件</option>
											</select>
										</td>
									</tr>

									<tr id="dp_slideshow_order_div">
										<td>スライドショー表示順序 : </td>
										<td>
											<select name="dp_slideshow_order" id="dp_slideshow_order" style="width:200px;">
												<option value='date' <?php if($options['dp_slideshow_order'] == 'date') echo "selected=\"selected\""; ?>>投稿日付順</option>
												<option value='rand' <?php if($options['dp_slideshow_order'] == 'rand') echo "selected=\"selected\""; ?>>ランダム</option>
												<option value='comment_count' <?php if($options['dp_slideshow_order'] == 'comment_count') echo "selected=\"selected\""; ?>>コメントの多い順</option>
												<option value='title' <?php if($options['dp_slideshow_order'] == 'title') echo "selected=\"selected\""; ?>>タイトル順</option>
											</select> ※対象が「指定記事」の場合
										</td>
									</tr>

									<tr>
										<td>スライドエフェクト : </td>
										<td>
											<div class="pd10px-btm">
												<select name="dp_slideshow_effect" id="dp_slideshow_effect" size="1" style="width:200px;">
													<option value='fade' <?php if($options['dp_slideshow_effect'] == 'fade') echo "selected=\"selected\""; ?>>フェードイン／アウト</option>
													<option value='horizontal' <?php if($options['dp_slideshow_effect'] == 'horizontal') echo "selected=\"selected\""; ?>>左にスライド</option>
													<option value='vertical' <?php if($options['dp_slideshow_effect'] == 'vertical') echo "selected=\"selected\""; ?>>上にスライド</option>
												</select> ※対象が「ヘッダー画像」の場合
											</div>

											<div>
												<input type="checkbox" name="dp_slideshow_easing_fx" id="dp_slideshow_easing_fx" value="true" <?php if ($options['dp_slideshow_easing_fx']) echo "checked"; ?> /> <label for="dp_slideshow_easing_fx">表示中のイージングエフェクトを有効にする</label>
											</div>
										</td>
									</tr>
									
									<tr class="mg24px-btm" style="position:relative;">
										<td>スライド間隔 : </td>
										<td>
											<input type="text" size=8 name="dp_slideshow_speed" id="dp_slideshow_speed" value="<?php echo $options['dp_slideshow_speed']; ?>" style="text-align:right;" /> ミリ秒 (1秒 = 1000)
										</td>
									</tr>

									<tr>
										<td>トランジション時間 : </td>
										<td>
											<input type="text" size=8 name="dp_slideshow_transition_time" id="dp_slideshow_transition_time" value="<?php echo $options['dp_slideshow_transition_time']; ?>" style="text-align:right;" /> ミリ秒 (1秒 = 1000)
										</td>
									</tr>

									<tr>
										<td>スライドナビゲーション : </td>
										<td>
											<div class="pd10px-btm">
												<input type="checkbox" name="dp_slideshow_nav_button" id="dp_slideshow_nav_button" value="true" <?php if ($options['dp_slideshow_nav_button']) echo "checked"; ?> /> <label for="dp_slideshow_nav_button">前後ナビゲーションを表示する</label>
											</div>
											<div>
												<input type="checkbox" name="dp_slideshow_control_button" id="dp_slideshow_control_button" value="true" <?php if ($options['dp_slideshow_control_button']) echo "checked"; ?> /> <label for="dp_slideshow_control_button">ドットナビゲーションを表示する</label>
											</div>
										</td>
									</tr>
								</table>
							</div>

							<div class="mg20px-btm">
								<div class="cl-a slide-title icon-attention"><?php _e('Note...', 'DigiPress'); ?></div>
								<div class="slide-content">
								※スライドショー対象として任意の指定記事を表示する場合は、投稿画面の<span class="red">投稿オプションにて「スライドショーに含める」にチェック</span>をして投稿しておいてください。<br />
								※画像上に<span class="red">タイトル、キャプションを表示</span>する場合は、「詳細設定」→「サイドメニュー／トップページタイトル設定」→「<span class="red">ヘッダー画像上のタイトル／キャプション設定</span>」にて指定してください。</br >	
								※ヘッダー画像またはスライドショー上に<span class="red">任意のウィジェットを表示</span>する場合は、WordPressウィジェット画面の「<span class="red">トップページ背景画像上</span>」に追加してください。</br >
								※<span class="red">モバイルテーマ</span>ではページネーション、コントロールボタンは表示されません。
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="clearfix mg10px-btm">
					<input name="dp_header_content_type" id="dp_header_content_type3" type="radio" value=3 <?php if ( $options['dp_header_content_type'] == 3 ) echo "checked"; ?> />
					<label for="dp_header_content_type3" class="mg20px-r b">ビデオ</label>
					
					<div id="full_bg_video_settings_top" class="mg20px-l">
						<div class="box-c">
							<table>
								<tbody>
								<tr>
									<td>ビデオURLまたはID :</td>
									<td><input type="text" size=35 name="fullscreen_video_url" id="fullscreen_video_url" value="<?php echo $options['fullscreen_video_url']; ?>" /> <span class="red ft12px">※YouTube または Vimeoのみ。</span></td>
								</tr>
								<tr>
									<td>再生開始位置 :</td>
									<td><input type="number" autocomplete="on" size=8 min=0 name="fullscreen_video_start" id="fullscreen_video_start" value="<?php echo $options['fullscreen_video_start']; ?>" style="width:60px;" /> 秒から</td>
								</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>

					
			<h3 class="dp_set_title2">モバイルテーマ用トップページヘッダー設定</h3>
				<div class="mg15px-l mg20px-btm">
						<div class="mg10px-btm">
							<input name="dp_header_content_type_mobile" id="dp_header_content_type_mobile_none" type="radio" value="none" <?php if ($options['dp_header_content_type_mobile'] == "none") echo "checked"; ?> />
							<label for="dp_header_content_type_mobile_none" class="mg20px-r b">何も表示しない</label>
						</div>

						<div class="mg10px-btm">
							<input name="dp_header_content_type_mobile" id="dp_header_content_type_mobile1" type="radio" value="1" <?php if($options['dp_header_content_type_mobile'] == 1) echo "checked"; ?> />
							<label for="dp_header_content_type_mobile1" class="mg20px-r b">ヘッダー画像の静止画表示</label>
						</div>

						<div id="header_banner_settings_mobile" class="mg20px-l">
							<div class="box-c">
							<h3 class="dp_set_title2">ヘッダー画像選択 :</h3>
							<div class="mg25px-l mg25px-btm">サイトの全画面背景画像、またはスライドショーの有無を選択できます。
							<div class="imgHover">
						<?php
						if ( !empty($dp_theme_mb_header_images) ) {
							echo '<ul class="clearfix thumb">';
							foreach ($dp_theme_mb_header_images[0] as $key => $current_image) {
								//Current Image
								if ($options['dp_header_img_mobile'] === $current_image) {
									$chk	= " checked";
								} else {
									$chk	= "";
								}
								echo '<li><div class="clearfix pd10px-btm">
									<img src="' . $current_image . '"  class="thumbBannerImg_crop" />
									<img src="' . $current_image . '" class="hiddenImg" /></div>
									<input name="dp_header_img_mobile" id="dp_header_img_mobile'.$key.'" type="radio" value="' . $current_image . '"' . $chk . ' />
									<label for="dp_header_img_mobile'.$key.'">' . $dp_theme_mb_header_images[1][$key] . '</label></li>';
							}
							echo '</ul>';

							$chkRandom = "";
							$chkNothing = "";
							if ($options['dp_header_img_mobile'] == 'random') {
								$chkRandom	= " checked='checked'";
							} else if (($options['dp_header_img_mobile'] == '') || ($options['dp_header_img_mobile'] == 'none') ) {
								$chkNothing	= " checked='checked'";
							}
							echo '</ul>';
							echo '<ul class="mg30px-top clearfix">'.
								 '<li class="fl-l"><input name="dp_header_img_mobile" id="dp_header_img_mobile_random" type="radio" value="random" '.$chkRandom.' /><span class="ft12px b pd15px-r"><label for="dp_header_img_mobile_random"> ランダム表示</label></span></li>
								<li class="fl-l"><input name="dp_header_img_mobile" id="dp_header_img_mobile_none" type="radio" value="none" '.$chkNothing.' /><label for="dp_header_img_mobile_none"> なし(テーマ既定画像)</label></li></ul>';
						} else {
							echo '<p class="red">アップロードされたイメージはまだありません。</p>';
						}
						?>	
									</div>
								</div>
							</div>
						</div>
				
				
						<div class="clearfix mg10px-btm">
							<input name="dp_header_content_type_mobile" id="dp_header_content_type_mobile2" type="radio" value="2" <?php if($options['dp_header_content_type_mobile'] == 2) echo "checked"; ?> />
							<label for="dp_header_content_type_mobile2" class="mg20px-r b">スライドショー</label>
							
							<div id="slideshow_settings_mobile" class="mg20px-l clearfix">
								<div class="box-c">
								<table class="tbl-picker pd12px-top">
									<tr>
										<td style="width:150px;">表示対象 : </td>
										<td>
											<select name="dp_slideshow_target_mobile" id="dp_slideshow_target_mobile" size="1" style="width:180px;">
												<option value='header_img' <?php if ($options['dp_slideshow_target_mobile'] == 'header_img') echo "selected=\"selected\""; ?>>ヘッダー画像</option>
												<option value='post' <?php if ($options['dp_slideshow_target_mobile'] == 'post') echo "selected=\"selected\""; ?>>指定記事</option>
												<option value='page' <?php if ($options['dp_slideshow_target_mobile'] == 'page') echo "selected=\"selected\""; ?>>指定固定ページ</option>
											</select>
										</td>
									</tr>

									<tr id="dp_slideshow_max_num_mobile_div">
										<td>最大表示数 : </td>
										<td>
											<select name="dp_number_of_slideshow_mobile" id="dp_number_of_slideshow_mobile" size="1" style="width:90px;">
											<option value='3' <?php if($options['dp_number_of_slideshow_mobile'] == '3') echo "selected=\"selected\""; ?>>～3件</option>
											<option value='4' <?php if($options['dp_number_of_slideshow_mobile'] == '4') echo "selected=\"selected\""; ?>>～4件</option>
											<option value='5' <?php if($options['dp_number_of_slideshow_mobile'] == '5') echo "selected=\"selected\""; ?>>～5件</option>
											<option value='6' <?php if($options['dp_number_of_slideshow_mobile'] == '6') echo "selected=\"selected\""; ?>>～6件</option>
											<option value="7" <?php if($options['dp_number_of_slideshow_mobile'] == '7') echo "selected=\"selected\""; ?>>～7件</option>
											<option value='8' <?php if($options['dp_number_of_slideshow_mobile'] == '8') echo "selected=\"selected\""; ?>>～8件</option>
											<option value="9" <?php if($options['dp_number_of_slideshow_mobile'] == '9') echo "selected=\"selected\""; ?>>～9件</option>
											<option value="10" <?php if($options['dp_number_of_slideshow_mobile'] == '10') echo "selected=\"selected\""; ?>>～10件</option>
											</select>
										</td>
									</tr>

									<tr >
										<td>スライドショー表示順序</td>
										<td>
											<select name="dp_slideshow_order_mobile" id="dp_slideshow_order_mobile" style="width:200px;">
												<option value='date' <?php if($options['dp_slideshow_order_mobile'] == 'date') echo "selected=\"selected\""; ?>>投稿日付順</option>
												<option value='rand' <?php if($options['dp_slideshow_order_mobile'] == 'rand') echo "selected=\"selected\""; ?>>ランダム</option>
												<option value='comment_count' <?php if($options['dp_slideshow_order_mobile'] == 'comment_count') echo "selected=\"selected\""; ?>>コメントの多い順</option>
												<option value='title' <?php if($options['dp_slideshow_order_mobile'] == 'title') echo "selected=\"selected\""; ?>>タイトル順</option>
											</select> ※対象が「指定記事」の場合
										</td>
									</tr>

									<tr>
										<td>スライドエフェクト : </td>
										<td>
											<div class="pd10px-btm">
												<select name="dp_slideshow_effect_mobile" id="dp_slideshow_effect_mobile" size="1" style="width:200px;">
													<option value='fade' <?php if($options['dp_slideshow_effect_mobile'] == 'fade') echo "selected=\"selected\""; ?>>フェードイン／アウト</option>
													<option value='horizontal' <?php if($options['dp_slideshow_effect_mobile'] == 'horizontal') echo "selected=\"selected\""; ?>>左にスライド</option>
													<option value='vertical' <?php if($options['dp_slideshow_effect_mobile'] == 'vertical') echo "selected=\"selected\""; ?>>上にスライド</option>
												</select>
											</div>
										</td>
									</tr>
									
									<tr class="mg24px-btm" style="position:relative;">
										<td>スライド間隔 : </td>
										<td>
											<input type="text" size=8 name="dp_slideshow_speed_mobile" id="dp_slideshow_speed_mobile" value="<?php echo $options['dp_slideshow_speed_mobile']; ?>" style="text-align:right;" /> ミリ秒 (1秒 = 1000)
										</td>
									</tr>

									<tr>
										<td>トランジション時間 : </td>
										<td>
											<input type="text" size=8 name="dp_slideshow_transition_time_mobile" id="dp_slideshow_transition_time_mobile" value="<?php echo $options['dp_slideshow_transition_time_mobile']; ?>" style="text-align:right;" /> ミリ秒 (1秒 = 1000)
										</td>
									</tr>
								</table>
								</div>
							</div>
						</div>
					</div>

				<h3 class="dp_set_title2">ヘッダー画像上フォントカラー設定</h3>
				<div class="mg25px-l mg25px-btm">
					<div class="sample_img icon-camera">
					表示サンプル
					<img src="<?php echo DP_THEME_URI ?>/inc/admin/img/header_banner_text_color.png" />
					</div>

					<table class="tbl-picker">
						<tr>
							<td>フォントカラー :</td>
							<td>
								<input type="text" name="header_banner_font_color" value="<?php echo $header_banner_font_color; ?>" class="dp-color-field" data-default-color="<?php echo $def_visual['header_banner_font_color']; ?>" />
							</td>
						</tr>
						<tr>
							<td>テキストシャドウ :</td>
							<td>
								<div class="fl-l mg15px-r"><input name="header_banner_text_shadow_enable" id="header_banner_text_shadow_enable" type="checkbox" value="true" <?php if ($options['header_banner_text_shadow_enable']) echo "checked"; ?> />
								<label for="header_banner_text_shadow_enable">表示する</label></div>
								<input type="text" name="header_banner_text_shadow_color" value="<?php echo $header_banner_text_shadow_color; ?>" class="dp-color-field" data-default-color="<?php echo $def_visual['header_banner_text_shadow_color']; ?>" />
							</td>
						</tr>
					</table>

					<div class="cl-a slide-title icon-attention"><?php _e('Note...', 'DigiPress'); ?></div>
					<div class="slide-content">
					※トップページのヘッダー画像／スライダーエリアのタイトルや任意コンテンツのテキストとリンクカラーに反映されます。<br />
					※<span class="red">テーマ標準のカラーに戻す場合</span>は、<span class="red">「デフォルト」ボタン</span>をクリックしてください。
					</div>
				</div>
			</dd>
	</dl>
<!-- 保存ボタン -->
<div class="mg20px-l mg20px-btm">
<input class="button button-primary" type="submit" name="dp_save_visual" value="<?php _e(' Save ', 'DigiPress'); ?>" />
</div>
</div>

<div class="mg10px-top mg20px-btm"><input class="button close_all" type="button" name="close_all" value=" <?php _e('Close All', 'DigiPress'); ?>" /></div>

<!--
========================================
テーマ基本フォントカスタマイズここから
========================================
-->
<h3 class="dp_h3 icon-menu">基本テキスト設定</h3>
<div class="dp_box">
	<dl>
			<!-- テーマ基本カラー設定 -->
			<dt class="dp_set_title1 icon-bookmark">基本フォント設定 :</dt>
				<dd>
				<div class="mg25px-btm">
					<div class="mg12px-btm clearfix" style="position:relative;">
						<table class="tbl-picker">
  						<tr>
							<td>フォントカラー :</td>
							<td>
								<input type="text" name="base_font_color" value="<?php echo $base_font_color; ?>" class="dp-color-field" data-default-color="<?php echo $def_visual['base_font_color']; ?>" />
							</td>
						</tr>
						<tr>
							<td>PCテーマ用フォントサイズ :</td>
							<td>
								<input type="text" size=4 class="fl-l mg10px-r" style="text-align:right;" id="base_font_size" name="base_font_size" value="<?php echo $options['base_font_size']; ?>" />
								<div class="fl-l pd20px-r pd5px-top">
		  				  			<input name="base_font_size_unit" id="base_font_size_unit1" type="radio" value="px" <?php if($options['base_font_size_unit'] === 'px') echo "checked"; ?> />
		  				  			<label for="base_font_size_unit1">px</label>
		  						</div>
				  				<div class="pd5px-top fl-l">
				  				  <input name="base_font_size_unit" id="base_font_size_unit2" type="radio" value="em" <?php if($options['base_font_size_unit'] === 'em') echo "checked"; ?> />
				  				  <label for="base_font_size_unit2">em</label>
				  				</div>
				  			</td>
				  		</tr>
				  		<tr>
							<td>モバイルテーマ用フォントサイズ :</td>
							<td>
								<input type="text" size=4 class="fl-l mg10px-r" style="text-align:right;" id="base_font_size_mb" name="base_font_size_mb" value="<?php echo $options['base_font_size_mb']; ?>" />
								<div class="fl-l pd20px-r pd5px-top">
		  				  			<input name="base_font_size_mb_unit" id="base_font_size_mb_unit1" type="radio" value="px" <?php if($options['base_font_size_mb_unit'] === 'px') echo "checked"; ?> />
		  				  			<label for="base_font_size_mb_unit1">px</label>
		  						</div>
				  				<div class="pd5px-top fl-l">
				  				  <input name="base_font_size_mb_unit" id="base_font_size_mb_unit2" type="radio" value="em" <?php if($options['base_font_size_mb_unit'] === 'em') echo "checked"; ?> />
				  				  <label for="base_font_size_mb_unit2">em</label>
				  				</div>
				  			</td>
				  		</tr>
						</table>
					</div>		

				<div class="cl-a slide-title icon-attention"><?php _e('Note...', 'DigiPress'); ?></div>
				<div class="slide-content">
				※記事本文など、サイト(テーマ)上で表示されるメインコンテンツのテキストのフォントが対象です。<br />
				※フォントサイズは、<span class="red">半角数字のみ</span>で入力してください。<br />
				※<span class="red">テーマ標準のカラーに戻す場合</span>は、<span class="red">「デフォルト」ボタン</span>をクリックしてください。
				</div>

				</div>
				</dd>
				
			<!-- テーマ基本リンク設定 -->
			<dt class="dp_set_title1 icon-bookmark">基本リンク設定 :</dt>
				<dd>
				<div class="mg25px-btm">
					<div class="mg20px-btm">
	  				<div class="fl-l pd20px-r">
	  				  <input name="base_link_underline" id="base_link_underline1" type="radio" value="1" <?php if($options['base_link_underline'] === '1') echo "checked"; ?> />
	  				  <label for="base_link_underline1">アンダーラインなし (※ホバー時のみ表示)</label>
	  				</div>
	  				<div>
	  				  <input name="base_link_underline" id="base_link_underline2" type="radio" value="2" <?php if($options['base_link_underline'] === '2') echo "checked"; ?> />
	  				  <label for="base_link_underline2">アンダーラインあり</label>
	  				</div>
	  				<div class="pd14px-top">
	  				  <input type="checkbox" id="base_link_bold" name="base_link_bold" value="true" <?php if($options['base_link_bold'] === 'true') echo "checked"; ?> />
	  				  <label for="base_link_bold">ボールド(太字)</label>
	  				</div>
					</div>

					<table class="mg12px-btm">
						<tr>
							<td>リンクカラー :</td>
							<td>
								<input type="text" name="base_link_color" value="<?php echo $base_link_color; ?>" class="dp-color-field" data-default-color="<?php echo $def_visual['base_link_color']; ?>" />
							</td>
						</tr>
						<tr>
							<td>リンクカラー(ホバー時) :</td>
							<td>
								<input type="text" name="base_link_hover_color" value="<?php echo $base_link_hover_color; ?>" class="dp-color-field" data-default-color="<?php echo $def_visual['base_link_hover_color']; ?>" />
							</td>
						</tr>
					</table>
					
					<div class="cl-a slide-title icon-attention mg12px-top"><?php _e('Note...', 'DigiPress'); ?></div>
					<div class="slide-content">
					※記事本文など、サイト(テーマ)上で表示される基本のリンクカラーが対象です。<br />
					※アンダーラインをなしにした場合は、ホバー時にアンダーラインが表示されます。<br />
					※<span class="red">テーマ標準のカラーに戻す場合</span>は、<span class="red">「デフォルト」ボタン</span>をクリックしてください。
					</div>

				</div>
				</dd>				
		</dl>

<!-- 保存ボタン -->
<div class="mg20px-l mg20px-btm">
<input class="button button-primary" type="submit" name="dp_save_visual" value="<?php _e(' Save ', 'DigiPress'); ?>" />
</div>
</div>
<!--
========================================
テーマ基本フォントカスタマイズここまで
========================================
-->

<div class="mg10px-top mg20px-btm"><input class="button close_all" type="button" name="close_all" value=" <?php _e('Close All', 'DigiPress'); ?>" /></div>


<!--
========================================
フッターデザインカスタマイズここから
========================================
-->
<h3 class="dp_h3 icon-menu">フッターエリア設定</h3>
<div class="dp_box">
	<dl>
		<!-- フッターエリアカラー設定 -->
		<dt class="dp_set_title1 icon-bookmark">フッターエリア設定 :</dt>
			<dd class="clearfix pd10px-btm">
			<div class="sample_img icon-camera">
			表示サンプル
			<img src="<?php echo DP_THEME_URI ?>/inc/admin/img/footer_color.png" />
			</div>

			<h3 class="dp_set_title2">テキストカラー設定 :</h3>
	
			<div class="mg25px-l mg30px-btm">
				<table class="pd12px-btm">
					<tr>
						<td>フォントカラー :</td>
						<td>
							<input type="text" name="footer_text_color" value="<?php echo $footer_text_color; ?>" class="dp-color-field" data-default-color="<?php echo $def_visual['footer_text_color']; ?>" />
						</td>
					</tr>
					<tr>
						<td>リンクカラー :</td>
						<td>
							<input type="text" name="footer_link_color" value="<?php echo $footer_link_color; ?>" class="dp-color-field" data-default-color="<?php echo $def_visual['footer_link_color']; ?>" />
						</td>
					</tr>

					<tr>
						<td>リンクカラー(ホバー時) :</td>
						<td>
							<input type="text" name="footer_link_hover_color" value="<?php echo $footer_link_hover_color; ?>" class="dp-color-field" data-default-color="<?php echo $def_visual['footer_link_hover_color']; ?>" />
						</td>
					</tr>
				</table>

				<div class="cl-a slide-title icon-attention"><?php _e('Note...', 'DigiPress'); ?></div>
				<div class="slide-content">
				※<span class="red">テーマ標準のカラーに戻す場合</span>は、<span class="red">「デフォルト」ボタン</span>をクリックしてください。
				</div>
			</div>


			<h3  class="dp_set_title2 mg35px-top">背景カラー設定 :</h3>
  				<div class="mg25px-l">
  					<table class="pd12px-btm">
						<tr>
							<td>背景カラー :</td>
							<td>
								<input type="text" name="footer_bgcolor" value="<?php echo $footer_bgcolor; ?>" class="dp-color-field" data-default-color="<?php echo $def_visual['footer_bgcolor']; ?>" />
							</td>
						</tr>
					</table>

	  				<div class="cl-a slide-title icon-attention"><?php _e('Note...', 'DigiPress'); ?></div>
		  			<div class="slide-content">
		  			※サイトフッター領域の背景カラーを指定します。<br />
		  			※<span class="red">テーマ標準の背景カラーに戻す場合</span>は、<span class="red">「デフォルト」ボタン</span>をクリックしてください。
		  			</div>
  				</div>
			</dd>
		
		<!-- フッターカラム数数 -->
		<dt class="dp_set_title1 icon-bookmark">フッターエリアのカラム(列)数 :</dt>
			<dd>
			<div class="mg12px-top">
			表示カラム数 : 
			<select name="footer_col_number" id="footer_col_number" size="1" style="width:100px;">
				<option value='1' <?php if($options['footer_col_number'] == 1) echo "selected=\"selected\""; ?>>1カラム</option>
				<option value='2' <?php if($options['footer_col_number'] == 2) echo "selected=\"selected\""; ?>>2カラム</option>
				<option value='3' <?php if($options['footer_col_number'] == 3) echo "selected=\"selected\""; ?>>3カラム</option>
				<option value='4' <?php if($options['footer_col_number'] == 4) echo "selected=\"selected\""; ?>>4カラム</option>
			</select>
			</div>
			
			<div class="cl-a slide-title icon-attention"><?php _e('Note...', 'DigiPress'); ?></div>
			<div class="slide-content">
			※フッターエリアのウィジェットコンテンツを何列(＝カラム)で表示するかを指定します。<br />
			※ここで指定したカラム数に合わせて<span class="red">列の幅は自動調整</span>されます。<br />
			※ウィジェトの追加は「外観」→「ウィジェット」画面にて "フッターウィジェット１〜３" のウィジェットエリアに追加してください。<br />
			※ウィジェットエリア直下のフッター用カスタムメニューを表示するには「外観」→「メニュー」にて編集してください。
			</div>
			</dd>
	</dl>
	<!-- 保存ボタン -->
	<div class="mg20px-l mg20px-btm">
	<input class="button button-primary" type="submit" name="dp_save_visual" value="<?php _e(' Save ', 'DigiPress'); ?>" />
	</div>
</div>
<!--
========================================
フッターエリアデザインカスタマイズここまで
========================================
-->

<div class="mg10px-top mg20px-btm"><input class="button close_all" type="button" name="close_all" value=" <?php _e('Close All', 'DigiPress'); ?>" /></div>


<!--
========================================
サイトテーマ背景カスタマイズここから
=========
-->
<h3 class="dp_h3 icon-menu">テーマ背景カスタマイズ</h3>
<div class="dp_box">
	<dl>
		<dt class="dp_set_title1 icon-bookmark">コンテナエリア設定 :</dt>
			<dd>
				<div class="sample_img icon-camera">対象エリア
				<img src="<?php echo DP_THEME_URI ?>/inc/admin/img/container_bg.png" />
				</div>
				
				<table class="mg25px-l mg25px-btm">
					<tr>
						<td>コンテナエリア背景カラー :</td>
						<td>
							<input type="text" name="container_bg_color" value="<?php echo $container_bg_color; ?>" class="dp-color-field" data-default-color="<?php echo $def_visual['container_bg_color']; ?>" />
						</td>
					</tr>
				</table>
			</dd>
			
		<!-- 背景カラー設定 -->
		<dt class="dp_set_title1 icon-bookmark">背景画像設定 :</dt>
			<dd>
			
			<!-- 背景画像一覧・選択 -->
			<h3 class="dp_set_title2">カスタム背景画像設定 :</h3>
				<div class="mg25px-l mg25px-btm">
					<div class="mg20px-btm">
					 <div><a href="#upload" id="bg_img_upload" class="button icon-image">背景画像をアップロード</a></div>
						<div class="mg25px-btm ft11px">アップロードメニューにジャンプします。<br />
						オリジナルの背景画像を使用する場合は、こちらよりアップロードを行います。</div>
					</div>
					<div class="imgHover">
					<?php

					if ( !empty($dp_theme_bg_images) ) {
						echo '<ul class="clearfix thumb">';
						foreach ($dp_theme_bg_images[0] as $key => $current_image) {
							//Current Image
							 if ($options['dp_background_img'] === $current_image) {
							 	$chk 	 =  " checked";
							 } else {
							 	$chk = "";
							 }
							 
							echo '<li><div class="clearfix pd10px-btm">
								 <img src="' . $current_image . '" class="thumbImgBg mg8px-btm" />
								 <img src="' . $current_image . '" class="hiddenImg" /> 
								 </div>
							<input name="dp_background_img" id="dp_background_img'.$key.'" type="radio" value="' . $current_image . '"' . $chk . ' />
							<label for="dp_background_img'.$key.'">' . $dp_theme_bg_images[1][$key] . '</label></li>';
						}
						// target
						$chkNone;
						if (($options['dp_background_img'] === 'none') || ($options['dp_background_img'] === '')) $chkNone	= "checked";

						// HTML
						echo '</ul>';
						echo '<ul>'.
						 	 '<li><p style="height:50px;">&nbsp;</p><input name="dp_background_img" id="dp_background_img_none" type="radio" value="none" ' . $chkNone . ' class="fl-l" /><label for="dp_background_img_none">画像なし</label></li></ul>';
					} else {
						echo '<p class="red">アップロードされたイメージはまだありません。</p>';
					}
					?>
					</ul>

					<div class="cl-a slide-title icon-attention"><?php _e('Note...', 'DigiPress'); ?></div>
					<div class="slide-content">
					※サムネイルにカーソルを合わせると実寸大のイメージが表示されます。<br />
					※<span class="red">テーマのデフォルトに戻す</span>場合は、<span class="red">「画像なし」を選択</span>して保存してください。<br />
					※<span class="red">背景画像を表示しない</span>場合は、<span class="red">「画像なし」を選択</span>して保存してください。<br />
					　ただし、<span class="red">背景カラーが未定義</span>の場合は、このオプションを選択しても<span class="red">反映されません</span>。<br />
					※コンテナエリアも含めて全体に背景画像を表示する場合は、コンテナ背景カラーを「<span class="red">transparent</span>」と指定して保存してください。<br />
					※イメージの保存先は「<?php echo DP_UPLOAD_DIR; ?>/background」です。
					</div>

				</div>
			</div>
			
			<!-- 画像表示方法 -->
			<h3 class="dp_set_title2">背景画像の表示方法 :</h3>
				<div class="mg25px-l mg25px-btm">
					<input name="dp_background_repeat" id="dp_background_repeat1" type="radio" value="repeat-x" <?php if($options['dp_background_repeat'] === 'repeat-x') echo "checked"; ?> />
					<span class="ft12px mg10px-r"><label for="dp_background_repeat1">
					平行(横)方向に繰り返し
					</label></span>
					<input name="dp_background_repeat" id="dp_background_repeat2"type="radio" value="repeat-y" <?php if($options['dp_background_repeat'] === 'repeat-y') echo "checked"; ?> />
					<span class="ft12px mg10px-r"><label for="dp_background_repeat2">
					垂直(縦)方向に繰り返し
					</span>
					<input name="dp_background_repeat" id="dp_background_repeat3"type="radio" value="repeat" <?php if($options['dp_background_repeat'] === 'repeat') echo "checked"; ?> />
					<span class="ft12px mg10px-r"><label for="dp_background_repeat3">
					全方向(縦・横)に繰り返し
					</span>
					<input name="dp_background_repeat" id="dp_background_repeat4"type="radio" value="no-repeat" <?php if($options['dp_background_repeat'] === 'no-repeat') echo "checked"; ?> />
					<span class="ft12px mg10px-r"><label for="dp_background_repeat4">
					繰り返しなし(固定表示)
					</span>

					<div class="cl-a slide-title icon-attention mg12px-top"><?php _e('Note...', 'DigiPress'); ?></div>
					<div class="slide-content">
					※カスタム背景画像を指定(使用)しない場合、このオプションは<span class="red">無効</span>です。
					</div>
				</div>
			</dd>
	</dl>
	<!-- 保存ボタン -->
	<div class="mg20px-l mg20px-btm">
	<input class="button button-primary" type="submit" name="dp_save_visual" value="<?php _e(' Save ', 'DigiPress'); ?>" />
	</div>
</div>
<!--
========================================
サイトテーマ背景カスタマイズここまで
=========
-->

<div class="mg10px-top mg20px-btm"><input class="button close_all" type="button" name="close_all" value=" <?php _e('Close All', 'DigiPress'); ?>" /></div>


<!--
========================================
オリジナルCSS
========================================
-->
<h3 class="dp_h3 icon-menu">オリジナルスタイルシート設定</h3>
<div class="dp_box" id="bg_custom">
	<dl>
		<dt class="dp_set_title1 icon-bookmark">オリジナルスタイルシート :</dt>
			<dd>
			<p>テーマのCSSに、オリジナルのスタイルを組み込むことができます。</p>
			<p>CSSを個別に編集・追加する場合は、テーマファイルのCSSを編集せずに以下のテキストエリアに記述してください。</p>
			<div class="mg15px-top">
			<textarea name="original_css" id="original_css" cols="50" rows="16" style="width:550px;"><?php echo($options['original_css']); ?></textarea>
			</div>
			<div class="cl-a slide-title icon-attention"><?php _e('Note...', 'DigiPress'); ?></div>
				<div class="slide-content">
				※CSSに関する知識が前提となります。<br />
				※オリジナルのスタイルシートによって、デザインやレイアウトが崩れた場合は、セレクタ名を変更するか、一旦すべての定義を削除してください。
				<p class="circle1">定義例</p>
				<div class="box-c"><pre><code class="bg-none">/* オリジナルCSSクラス(my-text)の指定 */
.my-text {
	font-weight:bold;
	font-size:18px;
	color:#0000ff;
	line-height:188%;
}
/* オリジナルID(my-title)の指定 */
#my-title {
	position:relative;
	top:12px;
	padding:2px 8px;
	display:block;
	font-size:22px;
}
</code></pre></div>
				</div>
			</dd>
	</dl>
<!-- 保存ボタン -->
<div class="mg20px-l mg20px-btm">
<input class="button button-primary" type="submit" name="dp_save_visual" value="<?php _e(' Save ', 'DigiPress'); ?>" />
</div>
</div>

<div class="mg10px-top mg20px-btm"><input class="button close_all" type="button" name="close_all" value=" <?php _e('Close All', 'DigiPress'); ?>" /></div>

<div><input class="button" type="submit" name="dp_reset_visual" value="<?php _e(' Restore Default ', 'DigiPress'); ?>" onclick="return confirm('現在の設定は全てクリアされます。初期状態に戻しますか？')" />
</div>
</form>
<!-- フォームの終了 -->
<!--
========================================
背景カスタマイズここまで
========================================
-->


</div>
</div>
