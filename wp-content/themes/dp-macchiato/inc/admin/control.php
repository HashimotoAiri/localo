<?php
// Get default values
global $def_control;

$top_normal_excerpt_length = is_numeric(mb_convert_kana($options['top_normal_excerpt_length'],"n")) ? $options['top_normal_excerpt_length'] : $def_control['top_normal_excerpt_length'];
$archive_normal_excerpt_length = is_numeric(mb_convert_kana($options['archive_normal_excerpt_length'],"n")) ? $options['archive_normal_excerpt_length'] : $def_control['archive_normal_excerpt_length'];

$js_jquery_ui = 
"<script>
var j$ = jQuery;
j$(document).ready(function() {
	j$('#sl_top_normal_excerpt_length').slider({
		range:'min',
		max:".$def_control['top_normal_excerpt_length'].",
		value:".$top_normal_excerpt_length.",
		slide:function(e, ui){
			j$(this).next('.current-value').val(ui.value);
		},
		create:function(e, ui){
			j$(this).next('.current-value').val(".$top_normal_excerpt_length.");
		}
	});
	j$('#sl_archive_normal_excerpt_length').slider({
		range:'min',
		max:".$def_control['archive_normal_excerpt_length'].",
		value:".$archive_normal_excerpt_length.",
		slide:function(e, ui){
			j$(this).next('.current-value').val(ui.value);
		},
		create:function(e, ui){
			j$(this).next('.current-value').val(".$archive_normal_excerpt_length.");
		}
	});
});
</script>";

$js_jquery_ui = str_replace(array("\r\n","\r","\n","\t"), '', $js_jquery_ui);
echo $js_jquery_ui;
?>
<div class="wrap">
<div id="dp_custom">
<h2 class="dp_h2 icon-equalizer"><?php _e('DigiPress Operation Details Settings', 'DigiPress'); ?></h2>
	<p class="ft11px"><?php echo DP_THEME_NAME . ' Ver.' . DP_OPTION_SPT_VERSION; ?></p>
<?php 
if ( get_option( DP_THEME_LICENSE_KEY_PHRASE.'_status' ) != 'valid' ) return;
dp_permission_check();
?>

<form method="post" action="#" name="dp_form" enctype="multipart/form-data">
<!--
========================================
サイト一般設定
========================================
-->
<h3 class="dp_h3 icon-menu">サイト一般動作設定</h3>
<div class="dp_box">
	<dl>
		<dt class="dp_set_title1 icon-bookmark">
		標準化設定 : 
		</dt>
			<dd>
			<div class="pd15px-top pd25px-btm " style="position:relative;">
				<div>
					<input name="use_google_jquery" id="use_google_jquery" type="checkbox" value="check" <?php if($options['use_google_jquery']) echo "checked"; ?> /><label for="use_google_jquery">圧縮済みのjQueryをGoogleから読み込む</label>
				</div>
			
				<div class="slide-title icon-attention mg12px-top"><?php _e('Note...', 'DigiPress'); ?></div>
				<div class="slide-content">
				※WordPress標準のjQuery（無圧縮）ではなく、Googleのサーバー上にある<span class="red">最適（軽量）化されたjQuery</span>を代わりに読み込む場合はこのオプションを有効にしてください。<br />
				※この機能を有効にすると、GoogleのCDN（コンテンツデリバリネットワーク）サーバー上にある常に<span class="red">最新の圧縮済みのjQueryがヘッダ（head）に指定され、セキュリティ対策と高速化</span>が期待できます。<br />
				※<span class="red">認証制サイト</span>などの場合は、GoogleのjQueryが正常に読み込めない場合があります。アコーディオンエフェクトなどJavascriptの処理が動かなくなったときは、このオプションを無効（WordPress標準のjQueryの利用）にしてください。<br />
				※通常はこのオプションを有効にしておくことをおすすめします。
				</div>
			</div>

			<div class="pd15px-top pd25px-btm " style="position:relative;">
				<table><tbody>
					<tr>
						<td>コンテンツ装飾スタイル :</td>
						<td><select id="decoration_type" name="decoration_type" size=1 style="width:280px;">
								<option value="own"<?php if($options['decoration_type'] == 'own') echo ' selected="selected"'; ?>>オリジナル装飾スタイルを使用する</option>
								<option value="bootstrap"<?php if($options['decoration_type'] == 'bootstrap') echo ' selected="selected"'; ?>>Bootstrapを使用する</option>
								<option value="none"<?php if($options['decoration_type'] == 'none') echo ' selected="selected"'; ?>>装飾スタイルを使用しない</option>
							</select>
						</td>
					</tr>
				</tbody></table>
				<div class="slide-title icon-attention mg12px-top"><?php _e('Note...', 'DigiPress'); ?></div>
				<div class="slide-content">
				※テキストや画像、ボタンなどのコンテンツを装飾するデザインスタイルのコンポーネントを選択します。<br />
				※テーマ標準の組み込み装飾スタイルの使い方は、以下のオンラインドキュメントを参照してください。<br />
				　→ <a href="https://digipress.digi-state.com/manual/html-decoration/" target="_blank">HTML装飾リファレンス</a><br />
				　→ <a href="https://digipress.digi-state.com/manual/icon-font-map/" target="_blank">アイコン一覧</a><br />
				※<a href="http://getbootstrap.com/" target="_blank">Bootstrap</a>をサポートする場合は、以下の公式ドキュメントを参照してください。<br />
				　→ <a href="http://getbootstrap.com/css/" target="_blank">CSSスタイリング</a><br />
				　→ <a href="http://getbootstrap.com/components/#dropdowns" target="_blank">コンポーネント</a>(※アイコンは除外)<br />
				　→ <a href="http://getbootstrap.com/javascript/" target="_blank">Javascript</a><br />
				※Bootstrapを利用する場合は、<span class="red">DigiPress専用プラグインの表示も一部崩れる</span>部分があります。コンテンツの装飾はすべてBootstrapの仕様に準拠するように制作してください。
				</div>
			</div>

			<div class="pd15px-top pd25px-btm">
				<div class="pd15px-btm">
					<input name="disable_wow_js" id="disable_wow_js" type="checkbox" value="check" <?php if($options['disable_wow_js']) echo "checked"; ?> /><label for="disable_wow_js">スクロールフェードインアニメーションを無効にする (PC)</label>
				</div>
				<div class="pd15px-btm">
					<input name="disable_wow_js_mb" id="disable_wow_js_mb" type="checkbox" value="check" <?php if($options['disable_wow_js_mb']) echo "checked"; ?> /><label for="disable_wow_js_mb">スクロールフェードインアニメーションを無効にする (モバイル)</label>
				</div>
			
				<div class="slide-title icon-attention"><?php _e('Note...', 'DigiPress'); ?></div>
				<div class="slide-content">
				※ページをスクロールした際に、ヘッダーコンテンツや投稿タイトル、ウィジェットタイトルなどのテーマ規定のオブジェクトを様々なフェードインモーションで表示する効果を無効にする場合に指定します。<br />
				※このオプションを指定して無効にした場合、ユーザーが<span class="red">個別に指定したアニメーション(class="wow ***")も無効</span>になります。<br />
				※このオプションを指定して無効にした場合、アニメーション用のCSSとJavascriptを読み込まないため、<span class="red">約30kb弱の転送量が削減</span>されます。ページの読み込み速度が遅い場合は軽量化対策としてこのオプションを指定してください。
				</div>
			</div>

			<div class="pd15px-top pd25px-btm " style="position:relative;">
				<div>
					<input name="disable_auto_format" id="disable_auto_format" type="checkbox" value="check" <?php if($options['disable_auto_format']) echo "checked"; ?> /><label for="disable_auto_format">WordPressの自動整形機能を無効にする (※投稿オプションにて記事単位でも指定可)</label>
					<div class="mg15px-l mg8px-top">
						└ <input name="replace_p_to_br" id="replace_p_to_br" type="checkbox" value="check" <?php if($options['replace_p_to_br']) echo "checked"; ?> /><label for="replace_p_to_br">改行は&lt;/ br&gt;タグに変換する</label>
						
					</div>
				</div>
			
				<div class="slide-title icon-attention mg12px-top"><?php _e('Note...', 'DigiPress'); ?></div>
				<div class="slide-content">
				※このオプションを有効にすると記事の改行をpタグやbrタグに自動変換したり、意図しないHTMLタグの除去を行ってしまうWordPressによる自動整形(除去)を防ぎます。<br />
				※自動整形を無効にした上で、記事の改行をその数だけ&lt;/ br&gt;タグに置換したい場合は「改行は&lt;/ br&gt;タグに変換する」をチェックして有効にしてください。
				</div>
			</div>

			<div class="pd15px-top pd25px-btm " style="position:relative;">
				<div>
					<input name="execute_php_in_widget" id="execute_php_in_widget" type="checkbox" value="check" <?php if($options['execute_php_in_widget']) echo "checked"; ?> /><label for="execute_php_in_widget">テキストウィジェットでPHPの実行を許可する</label>
				</div>
			
				<div class="slide-title icon-attention mg12px-top"><?php _e('Note...', 'DigiPress'); ?></div>
				<div class="slide-content">
				※このオプションを有効にするとWordPress標準の「テキストウィジェット」でPHPを直接記述してその実行を許可します。<br />
				※PHPを実行する箇所は必ず<span class="red">「&lt;?php 〜 ?&gt;」で囲った中に記述</span>してください。
				</div>
			</div>

			<div class="pd15px-top pd25px-btm " style="position:relative;">
				<div>
					<input name="disable_auto_ogp" id="disable_auto_ogp" type="checkbox" value="check" <?php if($options['disable_auto_ogp']) echo "checked"; ?> /><label for="disable_auto_ogp">OGP(Open Graph Protocol)の自動出力を無効にする</label>
				</div>
			
				<div class="slide-title icon-attention mg12px-top"><?php _e('Note...', 'DigiPress'); ?></div>
				<div class="slide-content">
				※プラグインなどによるOGPの出力を優先する場合など、DigiPressによるOGPタグの自動出力を停止したい場合にこのオプションを有効にします。<br />
				※DigiPressでは各ページごとでOGPを最適化してmetaタグ内に必要なOGPを自動で出力します。
				</div>
			</div>

			<div class="pd15px-top pd25px-btm " style="position:relative;">
				<div>
					<input name="disable_fix_post_slug" id="disable_fix_post_slug" type="checkbox" value="check" <?php if($options['disable_fix_post_slug']) echo "checked"; ?> /><label for="disable_fix_post_slug">記事のURL正規化(日本語スラッグの投稿ID変換)機能を無効にする</label>
				</div>
			
				<div class="slide-title icon-attention mg12px-top"><?php _e('Note...', 'DigiPress'); ?></div>
				<div class="slide-content">
				※投稿スラッグを明示せず、日本語タイトルのままのスラッグであった場合、投稿スラッグを投稿ID(post_id)付きの状態(post-%post_id%)に自動変換する機能を無効にする場合はこのオプションを有効にしてください。<br />
				※この機能の有無が影響するのは主にパーマリンク設定にて %post_name%(投稿スラッグ)を使用している場合に記事のURLが変わります。<br />
				※既に投稿済みの記事については、このオプションの有無の変更で投稿スラッグは変わりません(影響はありません)。
				</div>
			</div>

			<div class="pd15px-top pd15px-btm " style="position:relative;">
				<div>
					<input name="disable_emoji" id="disable_emoji" type="checkbox" value="check" <?php if($options['disable_emoji']) echo "checked"; ?> /><label for="disable_emoji">WordPressの絵文字自動変換機能を無効化</label>
				</div>
			
				<div class="slide-title icon-attention mg12px-top"><?php _e('Note...', 'DigiPress'); ?></div>
				<div class="slide-content">
				※WordPress 4.2よりサポートされた「<a href="https://codex.wordpress.org/Emoji" target="_blank">絵文字</a>」機能を無効化します。<br />
				※既定では、WordPressから自動的に絵文字を利用するための<span class="red">JavascriptとCSSがヘッダーに挿入</span>されます。通常、絵文字を利用しない場合は余計なスクリプトとCSSをロードさせて<span class="red">表示速度に影響を与えないように絵文字機能を無効化</span>しておくことを推奨します。
				</div>
			</div>

			<div class="pd15px-top pd15px-btm ">
				<input name="show_author_avatar" id="show_author_avatar" type="checkbox" value=1 <?php if($options['show_author_avatar']) echo "checked"; ?> />
				<label for="show_author_avatar">記事メタ情報の寄稿者名にアバターを表示する</label>
			</div>

			<div class="pd15px-top pd15px-btm ">
				<input name="date_eng_mode" id="date_eng_mode" type="checkbox" value="true" <?php if($options['date_eng_mode']) echo "checked"; ?> /> <label for="date_eng_mode">投稿日を英語で表示する </label>
			</div>
			</dd>

		<dt class="dp_set_title1 icon-bookmark">モバイルテーマ専用設定 : </dt>
			<dd>
				<div class="pd15px-top pd15px-btm " style="position:relative;">
					<div class="mg30px-btm">
						<div><input name="disable_mobile_fast" id="disable_mobile_fast" type="checkbox" value="check" <?php if($options['disable_mobile_fast']) echo "checked"; ?> /><label for="disable_mobile_fast">モバイルテーマを使用しない</label></div>
						<div class="slide-title icon-attention mg12px-top"><?php _e('Note...', 'DigiPress'); ?></div>
						<div class="slide-content">
						※このオプションを有効にすると、スマートフォン閲覧時の専用テーマ(モバイルテーマ)の表示が無効化されます。
						</div>
					</div>

					<div class="mg30px-btm">
						<input name="fixed_mb_header_bar" id="fixed_mb_header_bar" type="checkbox" value="check" <?php if($options['fixed_mb_header_bar']) echo "checked"; ?> /><label for="fixed_mb_header_bar">ヘッダータイトルバーを常に先頭に表示(フローティング化)</label>
					</div>

					<h3 class="dp_set_title2">スライドメニュー設定</h3>
					<div class="sample_img icon-camera">表示サンプル<img src="<?php echo DP_THEME_URI ?>/inc/admin/img/mobile_menu_position.png" /></div>
						<table class="dp_table1 mg15px-l">
						<tr>
							<td>スライド方向 : </td>
							<td>
								<select id="mb_slide_menu_position" name="mb_slide_menu_position" size=1 style="width:180px;">
									<option value="left"<?php if($options['mb_slide_menu_position'] == 'left') echo ' selected="selected"'; ?>>左にスライド表示</option>
									<option value="right"<?php if($options['mb_slide_menu_position'] == 'right') echo ' selected="selected"'; ?>>右にスライド表示</option>
									<option value="top"<?php if($options['mb_slide_menu_position'] == 'top') echo ' selected="selected"'; ?>>上からスライド表示</option>
									<option value="bottom"<?php if($options['mb_slide_menu_position'] == 'bottom') echo ' selected="selected"'; ?>>下からスライド表示</option>
								</select>
							</td>
						</tr>
						<tr>
							<td>ページに対するメニューの位置 : </td>
							<td>
								<select id="mb_slide_menu_zposition" name="mb_slide_menu_zposition" size=1 style="width:180px;">
									<option value="back"<?php if($options['mb_slide_menu_zposition'] == 'back') echo ' selected="selected"'; ?>>背面</option>
									<option value="front"<?php if($options['mb_slide_menu_zposition'] == 'front') echo ' selected="selected"'; ?>>前面</option>
									<option value="next"<?php if($options['mb_slide_menu_zposition'] == 'next') echo ' selected="selected"'; ?>>隣接</option>
								</select>
							</td>
						</tr>
					</table>
						<div class="slide-title icon-attention mg12px-top"><?php _e('Note...', 'DigiPress'); ?></div>
						<div class="slide-content">
						※モバイルテーマでメニューアイコンをタップした際に表示されるスライドメニューの表示位置を上下左右から選べます。<br />
						※メニュー自体の定義は、「外観」→「メニュー」から登録、編集してください。
						</div>
				</div>
			</dd>

		<dt class="dp_set_title1 icon-bookmark">パララックススクロールコンテンツ設定 : </dt>
			<dd>
			<div class="pd15px-top pd25px-btm">
				<div class="mg15px-btm">
					<input name="parallax_each_time" id="parallax_each_time" type="checkbox" value="check" <?php if($options['parallax_each_time']) echo "checked"; ?> /><label for="parallax_each_time">スクロールされる度にパララックスアニメーションを繰り返す</label>
				</div>
				<div class="mg15px-btm">
					<input name="parallax_disable_mobile" id="parallax_disable_mobile" type="checkbox" value="check" <?php if($options['parallax_disable_mobile']) echo "checked"; ?> /><label for="parallax_disable_mobile">モバイル端末(タブレット含む)でのパララックスアニメーションを無効化</label>
				</div>
			
				<div class="slide-title icon-attention mg12px-top"><?php _e('Note...', 'DigiPress'); ?></div>
				<div class="slide-content">
				※ここではサイトに表示するパララックススクロールコンテンツ全体に関する動作設定を定義します。<br />
				※パララックススクロールコンテンツはWordPress管理画面「外観」→「ウィジェット」の「DP - パララックスコンテンツ」ウィジェットで作成してください。<br />
				※タッチスクリーン対応デバイスでは、パララックスコンテンツの<span class="red">背景画像の視差効果は無効</span>となります。
				</div>
			</div>
			</dd>

		<dt class="dp_set_title1 icon-bookmark">ページナビゲーション設定 : </dt>
			<dd>
			<div class="sample_img icon-camera">
				表示サンプル
				<img src="<?php echo DP_THEME_URI ?>/inc/admin/img/pagenation.png" />
				</div>
			<div class="mg8px-top ">
			<input name="pagenation" id="pagenation" type="checkbox" value="check" <?php if($options['pagenation']) echo "checked"; ?> />
			<label for="pagenation">拡張ページナビゲーションを使用する</label>

			
				<div class="slide-title icon-attention mg12px-top"><?php _e('Note...', 'DigiPress'); ?></div>
				<div class="slide-content">
				※インデックスページとアーカイブページでのページ送りリンクを、前または次のページへのリンク表示から、複数のページ送りリンク表示に変更する場合に有効にします。<br />
				※トップページの場合のみ、2ページ目以降にてページナビゲーションが表示されます。
				</div>
			</div>

			<div class="mg25px-top ">
				<div class="mg12px-btm"><input name="autopager" id="autopager" type="checkbox" value="check" <?php if($options['autopager']) echo "checked"; ?> />
				<label for="autopager">オートページャーを使用する(PC)</label></div>
				<div><input name="autopager_mb" id="autopager_mb" type="checkbox" value="check" <?php if($options['autopager_mb']) echo "checked"; ?> />
				<label for="autopager_mb">オートページャーを使用する(モバイル)</label></div>

				<div class="slide-title icon-attention mg12px-top"><?php _e('Note...', 'DigiPress'); ?></div>
				<div class="slide-content">
				※トップページやアーカイブページにて、次ページへ遷移せずに同一ページにて次の指定件数の記事を自動で追加して読み込む場合にこのオプションを有効にしてください。
				</div>
			</div>
			</dd>
		
		<dt class="dp_set_title1 icon-bookmark" id="settings_gcs">Google カスタム検索設定 : </dt>
			<dd>
			<label for="gcs_id">検索エンジンID:</label> 
			<input id="gcs_id" name="gcs_id" type="text" value="<?php echo $options['gcs_id']; ?>" size="40" /> 
			<a href="http://www.google.com/cse/manage/all" target="_blank">Googleで作成・確認</a>
			<div class="slide-title icon-attention mg12px-top"><?php _e('Note...', 'DigiPress'); ?></div>
			<div class="slide-content">
			※この設定は、サイト内検索機能として Google カスタム検索 を使う場合に、対象の検索エンジンを特定するための Google カスタム検索 にて作成されているIDを指定します。<br />
			※<span class="red">検索ウィジェット</span>や、<span class="red">テーマに組み込まれている検索ボックス</span>を、Google カスタム検索 に置き換える場合は必ず指定してください。<br />

			<p class="circle1">検索エンジンの作成</p>
			<div>Googleカスタム検索で<a href="http://www.google.com/cse/manage/create" target="_blank">新しい検索エンジンを作成</a>します。<br />
			<img src="<?php echo DP_THEME_URI ?>/inc/admin/img/create_gcs.png" /></div>

			<p class="circle1">検索エンジンIDの確認</p>
			<div>
			<ol>
			<li><a href="http://www.google.com/cse/manage/all" target="_blank">検索エンジンの編集</a> から作成した検索エンジンの名前をリストから選びます。</li>
			<li>対象検索エンジンの「設定」画面の "基本" タブにある「検索エンジンID」ラベルをクリックして表示された "検索エンジンID" をペーストします。<br />
			<img src="<?php echo DP_THEME_URI ?>/inc/admin/img/gcs_id.png" /></li>
			</ol>
			</div>
			
			<p class="circle1">検索エンジンの設定 ※必須</p>
			<div>
			<ol>
			<li>カスタム検索エンジンの コントロールパネル から「デザイン」を選び、"レイアウトの選択" にて「<span class="ft15px b red">デザイン</span>」画面の "レイアウト" タブを選択し、「<span class="ft15px b red">保存してコードを取得</span>」ボタンをクリックします。<br />
			<img src="<?php echo DP_THEME_URI ?>/inc/admin/img/gcs_layout1.png" /></li>
			<li>検索ボックスコードの取得画面が表示されたら、「検索結果の詳細」ラベルをクリックし、最初に指定したカスタム検索エンジンを利用するサイトのURLとなっていることを確認して完了です。<br />
			<span class="ft13px b red">※コードを取得する必要はありません。</span></br />
			<img src="<?php echo DP_THEME_URI ?>/inc/admin/img/gcs_layout2.png" class="bd-grey" /><br />
			※この検索エンジンの設定を行わないと、Googleカスタム検索 が機能しません。</li>
			</ol>
			</div>
			</div>
			</dd>
		
		<dt class="dp_set_title1 icon-bookmark">アフィリエイト設定 : </dt>
			<dd>
			<h3 class="dp_set_title2">リンクシェア :</h3>
			<div class="mg15px-l ">
				<div class="mg15px-top">
					<label for="ls_token">トークン:</label> 
					<input id="ls_token" name="ls_token" type="text" value="<?php echo $options['ls_token']; ?>" size="50" /> 
					<a href="http://cli.linksynergy.com/cli/publisher/links/webServices.php" target="_blank">リンクシェアで作成・確認</a>
					<div class="slide-title icon-attention mg12px-top"><?php _e('Note...', 'DigiPress'); ?></div>
					<div class="slide-content">
					※この設定は、リンクシェアのアフィリエイトリンクを生成できるDigiPressの<span class="red">ショートコード([linkshare])を利用する場合に、デフォルトで使用するサイトアカウントのトークン</span>を指定するものです(ショートコード使用時に "token" パラメータを省略できます)。<br />
					※この設定が空欄の場合は、linkshareショートコードを利用する際に、"token" パラメータでトークンをその都度指定してください。<br />
					※linkshareショートコードの <span class="red">"token" パラメータを指定した場合は、デフォルトのトークンよりも "token" パラメータのトークンが優先</span>されます。<br />
					<p class="circle1">サイトアカウントのトークン確認方法</p>
						<div>
						<ol>
						<li>リンクシェアに<a href="http://cli.linksynergy.com/cli/publisher/links/webServices.php" target="_blank">ログインしてWebサービスメニューにアクセス</a>します。</li>
						<li>まだトークンを作成していない場合は、[トークンの更新]ボタンでトークンを生成します。<br />
						<img src="<?php echo DP_THEME_URI ?>/inc/admin/img/ls_token_create.png" class="bd-grey" />
						</li>
						<li>作成されたトークンをコピーし、上記テキストボックスにペーストして保存します。<br />
						<img src="<?php echo DP_THEME_URI ?>/inc/admin/img/ls_token_get.png" class="bd-grey" />
						</li>
						</ol>
						</div>
					</div>
					
					<div class="mg15px-top">
					<label for="ls_mid">ECサイトID(MID):</label> 
					<input id="ls_mid" name="ls_mid" type="text" value="<?php echo $options['ls_mid']; ?>" size="10" /> 
					<a href="http://cli.linksynergy.com/cli/publisher/programs/advertisers.php?my_programs=1" target="_blank">リンクシェアで確認</a>
					<div class="slide-title icon-attention mg12px-top"><?php _e('Note...', 'DigiPress'); ?></div>
					<div class="slide-content">
					※この設定は、リンクシェアのアフィリエイトリンクを生成できるDigiPressの<span class="red">ショートコード([linkshare])を利用する場合に、アフィリエイトに利用するデフォルトのECサイト</span>を指定するための MID を登録します。<br />
					※この設定が空欄の場合、または linkshareショートコードの "mid" パラメータを省略した場合は、<span class="red">リンクシェアアフィリエイト紹介プログラム(2451)が設定</span>されます。<br />
					※linkshareショートコードの <span class="red">"mid" パラメータを指定した場合は、デフォルトのMIDよりも "mid" パラメータの MID が優先</span>されます。<br />
					<p class="circle1">ECサイトID(MID)の確認方法</p>
						<div>
						<ol>
						<li>リンクシェアに<a href="http://cli.linksynergy.com/cli/publisher/programs/advertisers.php?my_programs=1" target="_blank">ログインして提携中のECサイトメニューにアクセス</a>します。</li>
						<li>参加プログラムリストの中から、デフォルトで利用したいECサイトのリンクにカーソルを合わせて、表示されたポップアップに記載の MID を上記テキストボックスに入力して保存します。<br />
						<img src="<?php echo DP_THEME_URI ?>/inc/admin/img/ls_mid.png" class="bd-grey" />
						</li>
						</ol>
						</div>
					</div>
				</div>
				</div>
			</div>

			<h3 class="dp_set_title2">iTunesパートナー アフィリエイトプログラム(PHG) :</h3>
			<div class="mg15px-l ">
				<div class="mg15px-top">
					<label for="phg_token">アフィリエイト・トークン:</label> 
					<input id="phg_token" name="phg_token" type="text" value="<?php echo $options['phg_token']; ?>" size="10" /> 
					<a href="https://phgconsole.performancehorizon.com/login/itunes" target="_blank">申し込み・トークン確認</a>
					<div class="slide-title icon-attention mg12px-top"><?php _e('Note...', 'DigiPress'); ?></div>
					<div class="slide-content">※この設定はDigiPressのショートコードにてiTunes Store, App Storeのアプリや音楽などのアフィリエイトリンクを生成する場合に設定しておく必要があります。<br />
						※ショートコードを利用する場合は、<span class="red">[phg url="https://itunes.apple.com/jp/app/APP_NAME/id12345678?mt=8&uo=4"]</span>のような形式でiTunes StoreのURLをパラメータに指定して記事やテキストウィジェットに指定してください。<br />
						※iTunesのアフィリエイトプログラムへの申し込みは<a href="http://www.apple.com/jp/itunes/affiliates/" target="_blank">こちら</a>から行ってください。iTunes Storeの商品リンクの検索は<a href="http://www.apple.com/jp/itunes/link/" target="_blank">こちら</a>から行えます。
					</div>
				</div>
			</div>
			
			<h3 class="dp_set_title2">Googleアドセンス :</h3>
			<div class="mg15px-l ">
				<div class="mg15px-top">
					<label for="adsense_id">サイト運営者 ID:</label> 
					<input id="adsense_id" name="adsense_id" type="text" value="<?php echo $options['adsense_id']; ?>" size="50" /> 
					<a href="https://www.google.com/adsense/v3/app?hl=ja#account" target="_blank">Googleアドセンスで確認</a><br />
					※IDの先頭にある "pub-" は省いてください。
					<div class="slide-title icon-attention mg12px-top"><?php _e('Note...', 'DigiPress'); ?></div>
					<div class="slide-content">
					※この設定は、Googleアドセンス広告を表示できるDigiPressの<span class="red">ショートコード([adsense])を利用する場合に、デフォルトで使用するGoogleアドセンスアカウントのサイト運営者ID</span>を指定するものです(ショートコード使用時に "id" パラメータを省略できます)。<br />
					※この設定が空欄の場合は、adsenseショートコードを利用する際に、"id" パラメータでサイト運営者IDをその都度指定してください。<br />
					※adsenseショートコードの <span class="red">"id" パラメータを指定した場合は、デフォルトのサイト運営者IDよりも "id" パラメータのIDが優先</span>されます。<br />
					<p class="circle1">Googleアドセンスアカウントの運営者ID確認方法</p>
						<div>
						<ol>
						<li>Googleアドセンスに<a href="https://www.google.com/adsense/v3/app?hl=ja#account" target="_blank">ログインしてアカウント設定にアクセス</a>します。</li>
						<li>アカウント情報の「サイト運営者ID」から "pub-" を省いたIDをコピーし、上記テキストボックスにペーストして保存します。<br />
						<img src="<?php echo DP_THEME_URI ?>/inc/admin/img/adsense_id.png" class="bd-grey" />
						</li>
						</ol>
						</div>
					</div>
				</div>
			</div>
			</dd>

		<dt class="dp_set_title1 icon-bookmark">コピーライト設定 : </dt>
			<dd>
				<label for="blog_start_year">サイト運営開設年(西暦):</label> 
				<input id="blog_start_year" name="blog_start_year" type="text" value="<?php echo $options['blog_start_year']; ?>" size="5" /> 年
				<div class="slide-title icon-attention mg12px-top"><?php _e('Note...', 'DigiPress'); ?></div>
				<div class="slide-content">
				※この設定は、フッターのコピーライト表記の開始年に利用されます。未指定の場合は、現在の西暦のみが表示されます。
				<p class="checked">例 (開始年に2010を指定):</p>
				<div class="box"><p>&copy; <span class="pink">2010-</span>2013 サイト名.</p>
					※ピンクの部分がセットされます。</div>
			</div>

			</dd>

		<dt class="dp_set_title1 icon-bookmark">カスタム投稿タイプ設定 : </dt>
			<dd>
				<table class="dp_table1">
					<tbody>
						<tr>
							<td>
								<label for="news_cpt_slug_id">「お知らせ」カスタム投稿タイプのスラッグ(ID):</label>
							</td>
							<td><a href=""></a><input id="news_cpt_slug_id" name="news_cpt_slug_id" type="text" value="<?php if ($options['news_cpt_slug_id']) { echo $options['news_cpt_slug_id'];} else {echo 'news';} ?>" size="15" />
							</td>
						</tr>
						<tr>
							<td>
								<label for="news_cpt_name">「お知らせ」カスタム投稿タイプの名前:</label>
							</td>
							<td><a href=""></a><input id="news_cpt_name" name="news_cpt_name" type="text" value="<?php if ($options['news_cpt_name']) { echo $options['news_cpt_name'];} else {echo $def_control['news_cpt_name'];} ?>" size="15" />
							</td>
						</tr>
					</tbody>
				</table>

				<div class="slide-title icon-attention mg12px-top"><?php _e('Note...', 'DigiPress'); ?></div>
				<div class="slide-content">
				※この設定は、「お知らせ」カスタム投稿タイプ専用のスラッグと表示名を任意の文字列に変えるときに指定してください。<br />
				※何も指定しない場合は「news」というスラッグが利用されますが、<span class="ft12px red">既に「news」というスラッグのカテゴリーが存在</span>していた場合は競合が発生するため表示されなくなります。このような場合は<span class="ft12px red">スラッグを変更</span>してください。<br />
				※この設定を変更したあとは、必ず<span class="b ft14px red">WordPressのパーマリンク設定を保存し直してください</span>。
			</div>

			</dd>

		<dt class="dp_set_title1 icon-bookmark">Twitter Card設定 : </dt>
			<dd>
				<label for="twitter_card_user_id">TwitterユーザーID:</label> 
				<input id="twitter_card_user_id" name="twitter_card_user_id" type="text" value="<?php echo $options['twitter_card_user_id']; ?>" size="20" /> (※@マークを除いたID) <a href="https://dev.twitter.com/ja/cards/troubleshooting#approval" target="_blank" class="icon-new-tab">カード承認手順</a>

				<div class="slide-title icon-attention mg12px-top"><?php _e('Note...', 'DigiPress'); ?></div>
				<div class="slide-content">
				※Twiter Cardとは、あなたのサイト内のページURLを含めた内容がTiwtterユーザーによってツイートされたとき、該当ユーザーの<span class="ft12px red">ツイート画面で自動的に表示される対象ページに関するリッチコンテンツ</span>です。ここでIDを設定しておくことで、ツイートされたときにページの概要が表示され、<span class="ft12px red">集客を促す効果が期待</span>できます。<br />
				※この機能を利用するには、事前に<span class="ft12px red">Twitter側でサイトの承認を得ておく必要</span>があります。カードの承認を受けるには<a href="https://dev.twitter.com/ja/cards/troubleshooting#approval" target="_blank">公式サイトの手順</a>をご覧ください。
				<div class="pd10px"><p class="b ft14px">表示例 :</p>
					<img src="<?php echo DP_THEME_URI ?>/inc/admin/img/twitter_card.png" />
				</div>
				※この機能は「All in One SEO Pack」プラグインを使用している場合は無効です。
				</div>
			</dd>
	</dl>
	
	<!-- 保存ボタン -->
<div class="mg20px-l mg20px-btm">
<input class="button button-primary" type="submit" name="dp_save" value="<?php _e(' Save ', 'DigiPress'); ?>" />
</div>
</div>
<!--
========================================
サイト一般設定
========================================
-->

<div class="mg10px-top mg20px-btm"><input class="button close_all" type="button" name="close_all" value=" <?php _e('Close All', 'DigiPress'); ?>" /></div>


<!--
========================================
HTMLヘッダー設定ここから
========================================
-->
<h3 class="dp_h3 icon-menu"><?php _e('HTML Head Part Setting', 'DigiPress'); ?></h3>
<div class="dp_box">
	<dl>
		<!-- titleタグのタイトル変更有無 -->
		<dt class="dp_set_title1 icon-bookmark">
		&lt;title&gt;タグにセットするサイト名の変更 :
		</dt>
			<dd>
			<div class="  mg12px-top">
			<input name="enable_title_site_name" id="enable_title_site_name" type="checkbox" value="check" <?php if($options['enable_title_site_name']) echo "checked"; ?> />
			<label for="enable_title_site_name">変更する</label>
			</div>
			
			<div id="html_title_block" class="mg15px-top">
			<!-- titleタグのタイトル -->
			<p class="dp_set_title2">
			&lt;title&gt;タグにセットするサイト名(TOP用) :
			</p>
				<div class="dp_indent1">
				<div class="">
				<input type="text" name="title_site_name_top" size="50" value="<?php echo($options['title_site_name_top']); ?>" /><p class="clearfix">※トップページのみに表示されるサイト名を指定します。</p>
				</div>
				</div>
			<p class="dp_set_title2">
			&lt;title&gt;タグにセットするサイト名(記事、アーカイブ用) :
			</p>
				<div class="dp_indent1">
				<div class="">
				<input type="text" name="title_site_name" size="50" value="<?php echo($options['title_site_name']); ?>" />
				<p class="clearfix">※<span class="red">「ページ名」→「サイト名」</span>の順で表示されます。</p>
				</div>
				</div>
			<p class="dp_set_title2">
			ページ名とサイト名のセパレータ(分割記号) :
			</p>
				<div class="dp_indent1">
				<div class="">
				<input type="text" name="title_site_name_separate" size="10" value="<?php echo($options['title_site_name_separate']); ?>" />
				</div>
				</div>

			<div class="slide-title icon-attention mg12px-top"><?php _e('Note...', 'DigiPress'); ?></div>
			<div class="slide-content">
			※「&lt;title&gt;タグにセットするサイト名の変更」がチェックされているときのみに反映されます。<br />
			※チェック(指定)しない場合は、<span class="red">「設定」⇒「一般」にて設定したサイト名(ヘッダー画像上のサイト名)で統一</span>されます。
			</div>
			
			</div>
			</dd>


		<!-- TOPページのmetaタグキーワードの指定 -->
		<dt>
		<p class="dp_set_title1 icon-bookmark">
		&lt;head&gt;～&lt;/head&gt;内の&lt;meta&gt;タグに関する設定 :
		</p>
		</dt>

			<dd>
				<p>※<span class="red">All in One SEO Packプラグインが使用されている場合</span>は、ここで設定した&lt;meta&gt;タグの情報は<span class="red">無効</span>になり、該当プラグインの設定が優先されます。</p>

				<!-- meta キーワードの設定 -->
				<p class="dp_set_title2">
				トップページの&lt;meta&gt;タグの’keywords’にセットするキーワード :
				</p>

					<div class="dp_indent1">
					<input name="enable_meta_def_kw" id="enable_meta_def_kw" type="checkbox" value="check" <?php if($options['enable_meta_def_kw']) echo "checked"; ?> />
					<label for="enable_meta_def_kw">指定する</label>
					</div>

					<div id="html_meta_kw_block" class="mg10px-top">
					<p class="dp_set_title2">
					セットするキーワード (半角カンマ「,」区切り)  :
					</p>
						<div class="dp_indent1">
						<div class="">
						<input type="text" name="meta_def_kw" size="80" value="<?php echo($options['meta_def_kw']); ?>" />
						
						<div class="slide-title icon-attention"><?php _e('Note...', 'DigiPress'); ?></div>
						<div class="slide-content">
						※上記「キーワード」オプションがチェックされているときのみに反映されます。<br />
						※1つのキーワードは、半角カンマ「,」で区切ってください。<br />
						※指定するキーワードは、<span class="red">最大で10個程度まで</span>を目安にしてください。<br />
						※<span class="red">アーカイブページでは、設定したキーワードに "アーカイブ名" が追加されたテキストが&lt;meta&gt;タグのキーワードとして自動的にセット</span>されます。<br />
						※<span class="red">記事ページでは、投稿時に指定した「記事のタグ」が&lt;meta&gt;タグのキーワードとして自動的にセット</span>されます。
						</div>

						</div>
						</div>
					</div>


				<!-- meta ディスクリプションの設定 -->
				<p class="dp_set_title2">
				&lt;meta&gt;タグの’description’にセットするサイト説明 :
				</p>

					<div class="dp_indent1">
					<input name="enable_meta_def_desc" id="enable_meta_def_desc" type="checkbox" value="check" <?php if($options['enable_meta_def_desc']) echo "checked"; ?> />
					<label for="enable_meta_def_desc">指定する</label>
					</div>
					
					<div id="html_meta_desc_block" class="mg10px-top">
					<p class="dp_set_title2">
					セットする説明文 :
					</p>
						<div class="dp_indent1">
						<textarea name="meta_def_desc" cols="70%" rows="3"><?php echo($options['meta_def_desc']); ?></textarea>
						
						<div class="slide-title icon-attention"><?php _e('Note...', 'DigiPress'); ?></div>
						<div class="slide-content">
						※上記「サイト説明」オプションがチェックされているときのみに反映されます。<br />
						※HTMLタグや改行は無効です。<br />
						※指定する説明文は、<span class="red">最大100文字程度まで</span>を目安にしてください。<br />
						※<span class="red">カテゴリページではカテゴリの説明文があればそちらが優先</span>されます。<br />
						※<span class="red">記事ページで、本文の抜粋をメタディスクリプションに指定</span>したい場合は、記事投稿時の<span class="red">「抜粋」欄に文章を記述</span>してください。<br />
						※オプションが有効で<span class="red">説明文を空</span>にした場合は、WordPressの「設定」⇒「一般」の<span class="red">”キャッチフレーズ”に指定したテキストが代入</span>されます。<br />
						※各アーカイブの複数ページ目(カテゴリの2ページ目以降など)では、<span class="red">自動的にページ数を付加してページごとで説明文が重複しない</span>ように設定されます。
						</div>

						</div>
					</div>


				<h3 class="dp_set_title2">OGP(Open Graph Protocol)設定 :</h3>

				<div class="mg10px-top mg20px-l">
					<table class="dp_table1">
						<tbody>
							<tr>
								<th>サイトのサムネイル画像URL(og:image) :</th>
								<td><input type="text" name="meta_ogp_img_url" size="60" value="<?php echo($options['meta_ogp_img_url']); ?>" /> ※300px x 300px以上推奨。</td>
							</tr>
						</tbody>
					</table>
					
					<div class="slide-title icon-attention mg15px-top"><?php _e('Note...', 'DigiPress'); ?></div>
					<div class="slide-content">
					※サムネイル画像のURLはサーバーからの<span class="red">相対パスではなく、http:// から始まる絶対パスで指定</span>してください。<br />
					※記事ページまたは固定ページでは、<span class="red">アイキャッチ画像または記事内に掲載した画像のURL</span>が自動的に "og:image" パラメータの値としてセットされます。<br />
					※このOGP設定は「All in One SEO Pack」プラグインを使用している場合は無効になります。
					</div>
				</div>

			</dd>
		
		<dt class="dp_set_title1 icon-bookmark">
		&lt;head&gt;～&lt;/head&gt;内のユーザー定義 :
		</dt>
			<dd>
			上記カスタマイズ項目以外に、&lt;head&gt;～&lt;/head&gt;内に任意の定義を含める場合は以下に記述してください。
			<div class="  mg12px-top">
			<textarea name="custom_head_content" id="custom_head_content" cols="100%" rows="5"><?php echo($options['custom_head_content']); ?></textarea>
			</div>

			<div class="slide-title icon-attention"><?php _e('Note...', 'DigiPress'); ?></div>
			<div class="slide-content">
			※headタグ内に、<span class="red">linkタグによる外部CSS、Javascriptなどの指定</span>や、<span class="red">metaタグによるOGPなどの指定</span>をしたい場合はここに記述してください。<br />
			※scriptタグによる<span class="red">Javascriptの直書き</span>も可能です。<br />
			※headタグへの追記は必ずここで指定し、テーマファイル(header.php)自体は絶対に変更しないでください。
			</div>
			</dd>
	</dl>
	
	<!-- 保存ボタン -->
<div class="mg20px-l mg20px-btm">
<input class="button button-primary" type="submit" name="dp_save" value="<?php _e(' Save ', 'DigiPress'); ?>" />
</div>
</div>
<!--
========================================
HTMLヘッダー設定ここまで
========================================
-->

<div class="mg10px-top mg20px-btm"><input class="button close_all" type="button" name="close_all" value=" <?php _e('Close All', 'DigiPress'); ?>" /></div>

<!--
========================================
サイトヘッダー表示設定ここから
========================================
-->
<h3 class="dp_h3 icon-menu">サイトタイトル／ヘッダーバーエリア設定</h3>
<div class="dp_box">
	<dl>
		<!-- h1タグのタイトル変更有無 -->
		<dt>
		<h3 class="dp_set_title1 icon-bookmark">
		サイトタイトル設定 :
		</h3>
		</dt>
			<dd>
			<div class="">
				<div class="sample_img icon-camera">
				表示サンプル
				<img src="<?php echo DP_THEME_URI ?>/inc/admin/img/h1_title_text.png" />
				</div>
			<input name="enable_h1_title" id="enable_h1_title" type="checkbox" value="check" <?php if($options['enable_h1_title']) echo "checked"; ?> />
			<label for="enable_h1_title">サイトタイトル(H1)を変更する</label>
			</div>

			<div id="h1_title_block" class="mg15px-top mg15px-l">
				<h3 class="dp_set_title2">サイトメインタイトル(H1) :</h3>
				<div class="dp_indent1">
					<div class="">
					<input type="text" name="h1_title" id="h1_title" size="50" value="<?php echo($options['h1_title']); ?>" />
					</div>
					<div class="slide-title icon-attention mg8px-top"><?php _e('Note...', 'DigiPress'); ?></div>
					<div class="slide-content">
					※ヘッダーバーに表示される、全ページ固定のメインサイト名(H1)を指定します。<br />
					※サイトタイトル(H1)をテキストで表示している場合に表示され、<span class="red">画像で表示している場合はそのタイトル画像の alt 属性に指定</span>されます。
					</div>
				</div>
			</div>

			<div class=" mg15px-top">
			<input name="enable_h2_title" id="enable_h2_title" type="checkbox" value="check" <?php if($options['enable_h2_title']) echo "checked"; ?> />
			<label for="enable_h2_title">キャプション(H2)を変更する</label>
			</div>

			<div id="h2_title_block" class="mg15px-top mg15px-l">
				<h3 class="dp_set_title2">サイトタイトルキャプション(H2) :</h3>
				<div class="dp_indent1">
					<div class="">
					<input type="text" name="h2_title" id="h2_title" size="50" value="<?php echo($options['h2_title']); ?>" />
					</div>
					<div class="slide-title icon-attention mg8px-top"><?php _e('Note...', 'DigiPress'); ?></div>
					<div class="slide-content">
					※ヘッダーバーエリアのメインサイト名(H1)直下に表示できるサイトキャプションを変更できます。<br />
					※表示しない場合は、空にして保存してください。
					</div>
				</div>
			</div>
			</dd>

		<dt class="dp_set_title1 icon-bookmark">グローバルメニュー右側コンテンツ設定 :</dt>
			<dd>
			<div class="">
				<div class="sample_img icon-camera">
				表示サンプル
				<img src="<?php echo DP_THEME_URI ?>/inc/admin/img/global_menu.png" />
				</div>

				<div class="mg15px-btm">
					<select name="global_menu_right_content" id="global_menu_right_content">
						<option value="sns"<?php if($options['global_menu_right_content'] === "sns") echo ' selected="selected"'; ?>>SNS, RSS, 検索フォームを表示</option>
						<option value="tel"<?php if($options['global_menu_right_content'] === "tel") echo ' selected="selected"'; ?>>電話番号を表示</option>
						<option value="none"<?php if($options['global_menu_right_content'] === "none") echo ' selected="selected"'; ?>>表示なし</option>
					</select>
				</div>
				
				<div id="global_menu_right_div1" class="mg15px-l box-c">
					<div class="mg15px-btm">
						<input name="show_global_menu_search" id="show_global_menu_search" type="checkbox" value="true" <?php if($options['show_global_menu_search']) echo "checked"; ?> /><label for="show_global_menu_search">検索フォームを表示する</label>
						<div id="show_floating_gcs_div" class="mg20px-l mg10px-top">
							<input name="show_floating_gcs" id="show_floating_gcs" type="checkbox" value="true" <?php if($options['show_floating_gcs']) echo "checked"; ?> />
							<label for="show_floating_gcs">検索フォームにGoogleカスタム検索を使用する</label>
						</div>
					</div>

					<div class="mg20px-top">
						<div class="mg15px-btm">
							<input name="show_global_menu_sns" id="show_global_menu_sns" type="checkbox" value="true" <?php if($options['show_global_menu_sns']) echo "checked"; ?> />
							<label for="show_global_menu_sns">SNSアイコンを表示する</label>
						</div>
					
						<div id="global_menu_sns_block" class="mg15px-top mg20px-l">
						<h3 class="dp_set_title2 icon-triangle-right">Twitter URL :</h3>
							<div class="dp_indent1">
							<div class="">
							<input type="text" name="global_menu_twitter_url" size="64" value="<?php echo($options['global_menu_twitter_url']); ?>" /><br />※サイト専用のTwitterアカウントのURL
							</div>
							</div>
						<h3 class="dp_set_title2 icon-triangle-right">Facebook URL :</h3>
							<div class="dp_indent1">
							<div class="">
							<input type="text" name="global_menu_fb_url" size="64" value="<?php echo($options['global_menu_fb_url']); ?>" /><br />※サイト専用のFacebookアカウントのURL
							</div>
							</div>
						<h3 class="dp_set_title2 icon-triangle-right">Google+ URL :</h3>
							<div class="dp_indent1">
							<div class="">
							<input type="text" name="global_menu_gplus_url" size="64" value="<?php echo($options['global_menu_gplus_url']); ?>" /><br />※サイト専用またはあなたのGoogle+アカウントのURL
							</div>
							</div>
						<h3 class="dp_set_title2 icon-triangle-right">Instagram URL :</h3>
							<div class="dp_indent1">
							<div class="">
							<input type="text" name="global_menu_instagram_url" size="64" value="<?php echo($options['global_menu_instagram_url']); ?>" /><br />※サイト専用またはあなたのアカウントのURL
							</div>
							</div>
						</div>

						<div class="mg15px-btm">
							<input name="show_global_menu_rss" id="show_global_menu_rss" type="checkbox" value="true" <?php if($options['show_global_menu_rss']) echo "checked"; ?> /><label for="show_global_menu_rss">RSSアイコンを表示する</label>
						</div>
						<div id="rss_to_feedly_div" class="mg15px-top mg20px-l">
							<input name="rss_to_feedly" id="rss_to_feedly" type="checkbox" value="true" <?php if($options['rss_to_feedly']) echo "checked"; ?> />
							<label for="rss_to_feedly">RSSをfeedlyにリダイレクトする</label>
						</div>


						<div class="slide-title icon-attention mg12px-top"><?php _e('Note...', 'DigiPress'); ?></div>
						<div class="slide-content">
						※対象外(非表示)とするSNSサービスがある場合は、URLを空にして保存してください。<br />
						※Googleカスタム検索を使用するには、事前に <span class="red">検索エンジンID の設定が必要</span>です。<br />
						<span class="red">[サイト一般動作設定] → [Google カスタム検索設定] </span>にて検索エンジンIDを指定してください。
						※グローバルメニューへのメニューの追加、表示は、WordPressのカスタムメニューから作成してください。<br />
						<a href="nav-menus.php" class="button">カスタムメニューはこちら</a>
						</div>
					</div>
				</div>

				<div id="global_menu_right_div2" class="mg15px-l box-c">
					電話番号 : <input type="text" name="global_menu_right_tel" value="<?php echo $options['global_menu_right_tel']; ?>" size="50" />
				</div>
			</dd>
	</dl>
	
	<!-- 保存ボタン -->
<div class="mg20px-l mg20px-btm">
<input class="button button-primary" type="submit" name="dp_save" value="<?php _e(' Save ', 'DigiPress'); ?>" />
</div>
</div>

<!--
========================================
サイトヘッダー表示設定ここまで
========================================
-->

<div class="mg10px-top mg20px-btm"><input class="button close_all" type="button" name="close_all" value=" <?php _e('Close All', 'DigiPress'); ?>" /></div>

<!--
========================================
トップページ表示設定ここから
========================================
-->
<h3 class="dp_h3 icon-menu">トップページ表示設定</h3>
<div class="dp_box">
	<dl>
		<dt class="dp_set_title1 icon-bookmark">ヘッダー画像上のタイトル／キャプション設定</dt>
				<dd>
				<div class="sample_img icon-camera">対象エリア<img src="<?php echo DP_THEME_URI ?>/inc/admin/img/header_banner_text_color.png" />
				</div>

				<table class="mg15px-btm">
					<tr>
						<td>メインタイトル :</td>
						<td><input type="text" size=40 name="header_img_h2" id="header_img_h2" value="<?php echo $options['header_img_h2']; ?>" /></td>
					</tr>
					<tr>
						<td>サブキャプション :</td>
						<td><textarea name="header_img_h3" id="header_img_h3" cols="42" rows="3" style="width:380px;"><?php echo($options['header_img_h3']); ?></textarea></td>
					</tr>
				</table>
				
				<div class="slide-title icon-attention"><?php _e('Note...', 'DigiPress'); ?></div>
				<div class="slide-content">
				※ここで設定したタイトルは、ヘッダーバーエリアのコンテンツが「ヘッダー画像の静止画表示」または「スライドショー(対象:ヘッダー画像)」の場合のみに表示されます。<br />
				※タイトルやキャプションを<span class="red">表示しない場合は値を空にして保存</span>してください。<br />
				※ヘッダー画像上に任意のフリーコンテンツを表示するには、「ウィジェット」管理画面の<span class="red">「トップページヘッダー画像上」</span>ウィジェットエリアにテキストウィジェットを利用して表示してください。<br />
				※このタイトルとキャプションは、ヘッダーバーのメインヘッダー(headerタグ)内のH1タイトル(テキストまたはロゴ画像)とは<span class="red">HTML5によって区別されているエリア</span>です。
				</div>
				</dd>
		<!-- TOPの表示コンテンツ -->
		<dt class="dp_set_title1 icon-bookmark">共通設定 :</dt>
			<dd>
			<h3 class="dp_set_title2">表示記事数設定 :</h3>
			<div class="dp_indent1">
				<div>PC : <div style="position:relative;left:80px;margin:-22px 0 10px 0;"><input type="text" name="number_posts_index" size="5" value="<?php if ($options['number_posts_index'] !== '') { echo $options['number_posts_index']; } else { echo get_option('posts_per_page'); } ?>" />記事</div>
				</div>
				<div>モバイル : <div style="position:relative;left:80px;margin:-22px 0 10px 0;"><input type="text" name="number_posts_index_mobile" size="5" value="<?php if ($options['number_posts_index_mobile'] !== '') { echo $options['number_posts_index_mobile']; } else { echo get_option('posts_per_page'); } ?>" />記事</div>
				</div>
				<div class="slide-title icon-attention"><?php _e('Note...', 'DigiPress'); ?></div>
				<div class="slide-content">
				※WordPressの既定値に戻すには、空欄にして保存してください。<br />
				※トップページ下部の記事一覧が対象です。
				</div>
			</div>

			<h3 class="dp_set_title2">ページナビゲーションテキスト設定 :</h3>
			<div class="dp_indent1">
				<div class="sample_img icon-camera">対象エリア
				<img src="<?php echo DP_THEME_URI ?>/inc/admin/img/text_for_2page_top.png" />
				</div>
				
				<table>
					<tbody>
						<tr>
							<td>2ページ目へのリンクテキスト : </td>
							<td>
								<input type="text" name="navigation_text_to_2page" size=30 value="<?php if ($options['navigation_text_to_2page']) { echo $options['navigation_text_to_2page']; } else { echo 'SHOW OLDER POSTS'; } ?>" />
							</td>
						</tr>
					</tbody>
				</table>

				<div class="slide-title icon-attention"><?php _e('Note...', 'DigiPress'); ?></div>
				<div class="slide-content">
				※トップページにはページナビゲーションではなく2ページ目へのリンクのみが表示されます。そのリンクに表示するテキストを指定できます。<br />
				※規定値に戻すには空にして保存してください。<br />
				※その他、全体のページナビゲーションの表示設定については「<span class="red b">サイト一般動作設定</span>」オプションにて変更してください。
				</div>
			</div>
			</dd>
		
		<!-- TOPの表示コンテンツ -->
		<dt class="dp_set_title1 icon-bookmark">
		トップページコンテンツ表示設定 :
		</dt>
			<dd>
				<!-- 表示有無 -->
				<div class="">
					<div class="sample_img icon-camera">
					対象エリア
					<img src="<?php echo DP_THEME_URI ?>/inc/admin/img/content_bottom.png" />
					</div>
				<input name="show_top_under_content" id="show_top_under_content" type="checkbox" value="check" <?php if((bool)$options['show_top_under_content']) echo "checked"; ?> />
				<label for="show_top_under_content">コンテンツを表示する</label>
				</div>
				
				<div id="home_bottom_content_dd" class="box">
					<!-- 最新記事の表示形式 -->
					<div id="top_posts_show_setting" class="pd15px-top">
						
						<!-- 対象カテゴリ -->
						<h4 class="dp_set_title2 pd12px-btm">
						対象カテゴリまたはカスタム投稿タイプの指定 :
						</h4>
						<div class="mg20px-l mg30px-btm ">
							<div class="mg12px-btm">
							<input name="show_specific_cat_index" id="show_specific_cat_index1" type="radio" value="none" <?php if(($options['show_specific_cat_index'] == '') || ($options['show_specific_cat_index'] === 'none')) echo "checked"; ?> />
							<label for="show_specific_cat_index1">指定しない (デフォルト)</label>
							</div>

							<div class="mg12px-btm">
							<input name="show_specific_cat_index" id="show_specific_cat_index2" type="radio" value="cat" <?php if($options['show_specific_cat_index'] === 'cat') echo "checked"; ?> />
							<label for="show_specific_cat_index2">特定のカテゴリの記事のみ表示する</label>
								<div class="mg15px-l pd12px-top" id="div_specific_cat_index">
									<div id="index_bottom_target_cat_div">対象カテゴリ : 
									<?php wp_dropdown_categories(
											array(
												'name'			=> 'specific_cat_index',
												'hierarchical'	=> 1,
												'selected'		=> $options['specific_cat_index']
											)
									); ?>
									</div>

									<div class="mg15px-btm">
									<input name="index_bottom_except_cat" id="index_bottom_except_cat" type="checkbox" value="true" <?php if($options['index_bottom_except_cat']) echo "checked"; ?> />
									<label for="index_bottom_except_cat">除外カテゴリを指定する</label>
									<div class="mg10px-top mg15px-l" id="index_bottom_except_cat_id_div">除外カテゴリID : <input type="text" name="index_bottom_except_cat_id" size="20" value="<?php echo($options['index_bottom_except_cat_id']); ?>" />
									</div>
									<div class="slide-title icon-attention mg10px-top"><?php _e('Note...', 'DigiPress'); ?></div>
									<div class="slide-content">
									※除外カテゴリIDは<span class="red">半角数字</span>で指定してください。<br />
									※IDを複数指定する場合は、<span class="red">カンマ( , )</span>で区切ってください。<br />
									※除外カテゴリの指定を有効にした場合は、対象カテゴリ設定は無効になります。
									</div>
									</div>
								</div>
							</div>
							<div>
							<input name="show_specific_cat_index" id="show_specific_cat_index3" type="radio" value="custom" <?php if($options['show_specific_cat_index'] === 'custom') echo "checked"; ?> />
							<label for="show_specific_cat_index3">特定のカスタム投稿タイプの記事のみ表示する</label>
								<div class="mg15px-l pd12px-top" id="div_specific_post_type_index">対象カスタム投稿タイプ : 
								<?php $post_types = get_post_types(
										array(
											'public'	=> true,
											'_builtin'	=> false),
										'objects'
										); ?>
								<select name="specific_post_type_index" class="postform">
								<?php
								foreach ($post_types as $post_type ) {
									if ($options['specific_post_type_index'] === $post_type->name) {
										echo '<option value="' . $post_type->name . '" selected="selected">' . $post_type->label . '</option>';
									} else {
										echo '<option value="' . $post_type->name . '">' . $post_type->label . '</option>';
									}
								} ?>
								</select>
								</div>
							</div>
						</div>

					<h4 class="dp_set_title2 pd12px-btm">記事一覧のメインタイトル :</h4>
						<div class="mg12px-l mg20px-btm"><input type="text" name="top_posts_list_title" size=30 value="<?php echo($options['top_posts_list_title']); ?>" /><br />
							<span class="ft11px">※<span class="red">タイトルを表示しない</span>場合は、<span class="red">テキストボックスを空にして保存</span>してください。</span></div>
						</div>
						
					<h4 class="dp_set_title2 pd12px-btm">各記事の表示形式 :</h4>
						<div class="clearfix mg20px-l">
							<div class="sample_img icon-camera">表示サンプル
								<img src="<?php echo DP_THEME_URI ?>/inc/admin/img/post_archive_style.png" />
							</div>

							<select name="top_post_show_type" id="top_post_show_type">
								<option value="normal"<?php if($options['top_post_show_type'] === 'normal')  echo ' selected="selected"'; ?>>ノーマル</option>
								<option value="portfolio one"<?php if($options['top_post_show_type'] === 'portfolio one')  echo ' selected="selected"'; ?>>ポートフォリオ 1</option>
								<option value="portfolio two"<?php if($options['top_post_show_type'] === 'portfolio two')  echo ' selected="selected"'; ?>>ポートフォリオ 2</option>
								<option value="magazine one"<?php if($options['top_post_show_type'] === 'magazine one')  echo ' selected="selected"'; ?>>マガジン</option>
							</select>

							<div id="top_masonry_params" class="mg10px-btm box-c">
								<h4 class="mg5px-btm icon-triangle-right">詳細オプション :</h4>
								<div id="top_listing_post_style1" class="bg-white mg15px-l mg15px-btm pd15px">
									<div class="b mg10px-btm">ポートフォリオ／マガジン用</div>
									<div class="mg10px-btm mg15px-l">
										カラム数 : 
										<select name="top_masonry_lines">
											<option value="two_lines" <?php if($options['top_masonry_lines'] === 'two_lines') echo 'selected="selected"' ?>>２列</option>
											<option value="three_lines" <?php if($options['top_masonry_lines'] === 'three_lines') echo 'selected="selected"' ?>>３列</option>
											<option value="four_lines" <?php if($options['top_masonry_lines'] === 'four_lines') echo 'selected="selected"' ?>>４列（１カラムのみ）</option>
										</select>
									</div>
									<div class="b mg10px-btm">ポートフォリオ用</div>
									<div class="mg15px-l mg15px-btm">
										<div class="mg10px-btm">
											<input name="top_cat_color_layer" id="top_cat_color_layer"  type="checkbox" value="check" <?php if($options['top_cat_color_layer']) echo "checked"; ?> />
											<label for="top_cat_color_layer">カテゴリーカラーを記事メタ情報オーバーレイに反映</label>
										</div>
										<div>
											<input name="top_show_flip_on_hover" id="top_show_flip_on_hover"  type="checkbox" value="check" <?php if($options['top_show_flip_on_hover']) echo "checked"; ?> />
											<label for="top_show_flip_on_hover">ホバー時に記事メタ情報を表示する</label>
										</div>
									</div>
									<div class="b mg10px-btm">メタ情報オプション</div>
									<div class="mg15px-l">
										<div class="mg10px-btm">
											<input name="top_archive_list_date" id="top_archive_list_date"  type="checkbox" value="check" <?php if($options['top_archive_list_date']) echo "checked"; ?> />
											<label for="top_archive_list_date">投稿日を表示</label>
										</div>
										<div class="mg10px-btm">
											<input name="top_archive_list_author" id="top_archive_list_author"  type="checkbox" value="check" <?php if($options['top_archive_list_author']) echo "checked"; ?> />
											<label for="top_archive_list_author">寄稿者名を表示</label>
										</div>
										<div class="mg10px-btm">
											<input name="top_archive_list_cat" id="top_archive_list_cat"  type="checkbox" value="check" <?php if($options['top_archive_list_cat']) echo "checked"; ?> />
											<label for="top_archive_list_cat">カテゴリを表示</label>
										</div>
										<div class="mg10px-btm">
											<input name="top_archive_list_views" id="top_archive_list_views"  type="checkbox" value="check" <?php if($options['top_archive_list_views']) echo "checked"; ?> />
											<label for="top_archive_list_views">ページ閲覧回数を表示</label>
										</div>

										<div class="pd10px-btm">SNSシェアカウント表示設定 :</div>
										<div class="mg15px-l">
											<div class="mg6px-btm">
											<input name="hatebu_number_after_title_top" id="hatebu_number_after_title_top"  type="checkbox" value="check" <?php if($options['hatebu_number_after_title_top']) echo "checked"; ?> />
											<label for="hatebu_number_after_title_top">はてなブックマーク数を表示</label>
											</div>
											
											<div class="mg6px-btm disp-none">
											<input name="tweet_number_after_title_top" id="tweet_number_after_title_top"  type="checkbox" value="check" <?php if($options['tweet_number_after_title_top']) echo "checked"; ?> />
											<label for="tweet_number_after_title_top">ツイート数を表示</label>
											</div>

											<div class="mg15px-btm">
											<input name="likes_number_after_title_top" id="likes_number_after_title_top"  type="checkbox" value="check" <?php if($options['likes_number_after_title_top']) echo "checked"; ?> />
											<label for="likes_number_after_title_top">Facebookの「いいね！」数を表示</label>
											</div>
										</div>

										<div id="top_listing_post_style2">
											<span class="mg5px-r">概要文字数(ノーマル／マガジン) : </span>
											<div id="sl_top_normal_excerpt_length" style="display:inline-block;width:300px;"></div><input type="text" value="<?php echo $top_normal_excerpt_length; ?>" id="top_normal_excerpt_length" name="top_normal_excerpt_length" size="3" class="mg20px-l al-r current-value" readonly="readonly" />文字
										</div>
									</div>
								</div>
							</div>

							<div class="slide-title icon-attention mg15px-top"><?php _e('Note...', 'DigiPress'); ?></div>
							<div class="slide-content">
							※「全文」表示以外の場合は、<span class="red">投稿サムネイル(アイキャッチ画像 or 記事内の画像の自動選択)</span>が表示されます。アイキャッチ画像はWordPressの記事編集画面にて記事ごとにアップロードや指定が行えます。<br />
							※アイキャッチ画像が記事に設定されていない場合は、<span class="red">記事内で最初に見つかったimgタグの画像</span>を投稿サムネイルとして表示します。<br />
							※アイキャッチ画像も記事内に画像も見つからない場合は、DigiPressが持つ"No Image"用の画像からランダムに選ばれ表示されます。<br />
							※DigiPressの既定のNo Image用画像を変更する場合は、<span class="red">テーマフォルダの "/img/post_thumbnail/"</span>内の画像を自由に置き換えてください。
							</div>
						</div>
					</div>
			</dd>
	</dl>
	
	<!-- 保存ボタン -->
<div class="mg20px-l mg20px-btm">
<input class="button button-primary" type="submit" name="dp_save" value="<?php _e(' Save ', 'DigiPress'); ?>" />
</div>
</div>
<!--
========================================
トップページ表示設定ここまで
========================================
-->

<div class="mg10px-top mg20px-btm"><input class="button close_all" type="button" name="close_all" value=" <?php _e('Close All', 'DigiPress'); ?>" /></div>

<!--
========================================
アーカイブページ表示設定ここから
========================================
-->
<h3 class="dp_h3 icon-menu">アーカイブページ表示設定</h3>
<div class="dp_box">
<p>アーカイブページとは、<span class="red">サイトトップ、カテゴリー、検索結果、年月日別などの記事一覧が表示される形式(単一記事、単一ページ以外)のページ</span>を指します。</p>
	<dl>
		<!-- アーカイブページ記事表示タイプ -->
		<dt class="dp_set_title1 icon-bookmark">
		共通設定 :
		</dt>
			<dd>
				<h3 class="dp_set_title2">表示記事数設定 :</h3>
				<div class="dp_indent1">
					<h4 class="dp_set_title3">PC用</h4>
					<div class="mg15px-l">
						<div>
						カテゴリーページ : <div style="position:relative;left:120px;margin:-22px 0 10px 0;"><input type="text" name="number_posts_category" size="5" value="<?php if ($options['number_posts_category'] !== '') { echo $options['number_posts_category']; } else { echo get_option('posts_per_page'); } ?>" />記事</div>
						</div>
						<div>
						タグページ : <div style="position:relative;left:120px;margin:-22px 0 10px 0;"><input type="text" name="number_posts_tag" size="5" value="<?php if ($options['number_posts_tag'] !== '') { echo $options['number_posts_tag']; } else { echo get_option('posts_per_page'); } ?>" />記事</div>
						</div>
						<div>
						検索結果ページ : <div style="position:relative;left:120px;margin:-22px 0 10px 0;"><input type="text" name="number_posts_search" size="5" value="<?php if ($options['number_posts_search'] !== '') { echo $options['number_posts_search']; } else { echo get_option('posts_per_page'); } ?>" />記事</div>
						</div>
						<div>
						日付アーカイブ : <div style="position:relative;left:120px;margin:-22px 0 10px 0;"><input type="text" name="number_posts_date" size="5" value="<?php if ($options['number_posts_date'] !== '') { echo $options['number_posts_date']; } else { echo get_option('posts_per_page'); } ?>" />記事</div>
						</div>
						<div>
						寄稿者アーカイブ : <div style="position:relative;left:120px;margin:-22px 0 10px 0;"><input type="text" name="number_posts_author" size="5" value="<?php if ($options['number_posts_author'] !== '') { echo $options['number_posts_author']; } else { echo get_option('posts_per_page'); } ?>" />記事</div>
						</div>
					</div>
					
					<h4 class="dp_set_title3">モバイル用</h4>
					<div class="mg15px-l">
						<div>
						カテゴリーページ : <div style="position:relative;left:120px;margin:-22px 0 10px 0;"><input type="text" name="number_posts_category_mobile" size="5" value="<?php if ($options['number_posts_category_mobile'] !== '') { echo $options['number_posts_category_mobile']; } else { echo get_option('posts_per_page'); } ?>" />記事</div>
						</div>
						<div>
						タグページ : <div style="position:relative;left:120px;margin:-22px 0 10px 0;"><input type="text" name="number_posts_tag_mobile" size="5" value="<?php if ($options['number_posts_tag_mobile'] !== '') { echo $options['number_posts_tag_mobile']; } else { echo get_option('posts_per_page'); } ?>" />記事</div>
						</div>
						<div>
						検索結果ページ : <div style="position:relative;left:120px;margin:-22px 0 10px 0;"><input type="text" name="number_posts_search_mobile" size="5" value="<?php if ($options['number_posts_search_mobile'] !== '') { echo $options['number_posts_search_mobile']; } else { echo get_option('posts_per_page'); } ?>" />記事</div>
						</div>
						<div>
						日付アーカイブ : <div style="position:relative;left:120px;margin:-22px 0 10px 0;"><input type="text" name="number_posts_date_mobile" size="5" value="<?php if ($options['number_posts_date_mobile'] !== '') { echo $options['number_posts_date_mobile']; } else { echo get_option('posts_per_page'); } ?>" />記事</div>
						</div>
						<div>
						寄稿者アーカイブ : <div style="position:relative;left:120px;margin:-22px 0 10px 0;"><input type="text" name="number_posts_author_mobile" size="5" value="<?php if ($options['number_posts_author_mobile'] !== '') { echo $options['number_posts_author_mobile']; } else { echo get_option('posts_per_page'); } ?>" />記事</div>
						</div>
					</div>

					<div class="slide-title icon-attention"><?php _e('Note...', 'DigiPress'); ?></div>
					<div class="slide-content">
					※WordPressの既定値に戻すには、空欄にして保存してください。
					</div>
				</div>

				<h3 class="dp_set_title2">ページナビゲーションテキスト設定 :</h3>
				<div class="dp_indent1">
					<div class="sample_img icon-camera">対象エリア
					<img src="<?php echo DP_THEME_URI ?>/inc/admin/img/text_for_2page_top.png" />
					</div>

					<table>
						<tbody>
							<tr>
								<td>2ページ目へのリンクテキスト : </td>
								<td>
									<input type="text" name="navigation_text_to_2page_archive" size=30 value="<?php if ($options['navigation_text_to_2page_archive']) { echo $options['navigation_text_to_2page_archive']; } else { echo 'SHOW OLDER POSTS'; } ?>" />
								</td>
							</tr>
						</tbody>
					</table>

					<div class="slide-title icon-attention"><?php _e('Note...', 'DigiPress'); ?></div>
					<div class="slide-content">
					※1ページ目にはページナビゲーションではなく2ページ目へのリンクのみが表示されます。そのリンクに表示するテキストを指定できます。<br />
					※規定値に戻すには空にして保存してください。<br />
					※その他、全体のページナビゲーションの表示設定については「<span class="red b">サイト一般動作設定</span>」オプションにて変更してください。
					</div>
				</div>

				<h3 class="dp_set_title2">アーカイブ別カラム数設定 :</h3>
				<div class="dp_indent1">
					<table>
						<tbody>
							<tr>
								<td>1カラムで表示するカテゴリーID : </td>
								<td>
									<input type="text" name="one_col_category" size=25 value="<?php echo $options['one_col_category']; ?>" />(※半角英数字、カンマ","区切り)<br />例: 12, cat-name, 22, blogroll 
								</td>
							</tr>
						</tbody>
					</table>
					<div class="slide-title icon-attention"><?php _e('Note...', 'DigiPress'); ?></div>
					<div class="slide-content">
					※サイト全体のカラム数に関係なく、1カラム(サイドバーなし)で表示したいカテゴリーページがある場合にその「<span class="red">カテゴリーID</span>」または「<span class="red">カテゴリースラッグ</span>」を半角英数字で指定してください。<br />
					※複数のカテゴリーを指定する場合は、カテゴリーIDやカテゴリースラッグを<span class="red">半角カンマ(,)で区切って指定</span>してください。
					</div>
				</div>
			</dd>

		<dt class="dp_set_title1 icon-bookmark">
		記事一覧表示形式設定 :
		</dt>
			<dd>
				<div>
					<div class="mg20px-btm">
						<h3 class="dp_set_title2 icon-triangle-right">共通設定</h3>

						<div class="clearfix mg20px-l">
							<div class="sample_img icon-camera">表示サンプル
								<img src="<?php echo DP_THEME_URI ?>/inc/admin/img/post_archive_style.png" />
							</div>

							<select name="archive_post_show_type" id="archive_post_show_type">
								<option value="normal"<?php if($options['archive_post_show_type'] === 'normal')  echo ' selected="selected"'; ?>>ノーマル</option>
								<option value="portfolio one"<?php if($options['archive_post_show_type'] === 'portfolio one')  echo ' selected="selected"'; ?>>ポートフォリオ 1</option>
								<option value="portfolio two"<?php if($options['archive_post_show_type'] === 'portfolio two')  echo ' selected="selected"'; ?>>ポートフォリオ 2</option>
								<option value="magazine one"<?php if($options['archive_post_show_type'] === 'magazine one')  echo ' selected="selected"'; ?>>マガジン</option>
							</select>

							<div id="archive_masonry_params" class="mg10px-btm box-c">
								<h4 class="mg5px-btm icon-triangle-right">詳細オプション :</h4>
								<div id="archive_listing_post_style1" class="bg-white mg15px-l mg15px-btm pd15px">
									<div class="b mg10px-btm">ポートフォリオ／マガジン用</div>
									<div class="mg10px-btm mg15px-l">
										カラム数 : 
										<select name="archive_masonry_lines">
											<option value="two_lines" <?php if($options['archive_masonry_lines'] === 'two_lines') echo 'selected="selected"' ?>>２列</option>
											<option value="three_lines" <?php if($options['archive_masonry_lines'] === 'three_lines') echo 'selected="selected"' ?>>３列</option>
											<option value="four_lines" <?php if($options['archive_masonry_lines'] === 'four_lines') echo 'selected="selected"' ?>>４列（１カラムのみ）</option>
										</select>
									</div>
									<div class="b mg10px-btm">ポートフォリオ用</div>
									<div class="mg15px-l mg15px-btm">
										<div class="mg10px-btm">
											<input name="archive_cat_color_layer" id="archive_cat_color_layer"  type="checkbox" value="check" <?php if($options['archive_cat_color_layer']) echo "checked"; ?> />
											<label for="archive_cat_color_layer">カテゴリーカラーを記事メタ情報オーバーレイに反映</label>
										</div>
										<div>
											<input name="archive_show_flip_on_hover" id="archive_show_flip_on_hover"  type="checkbox" value="check" <?php if($options['archive_show_flip_on_hover']) echo "checked"; ?> />
											<label for="archive_show_flip_on_hover">ホバー時に記事メタ情報を表示する</label>
										</div>
									</div>
									<div class="b mg10px-btm">メタ情報オプション</div>
									<div class="mg15px-l">
										<div class="mg10px-btm">
											<input name="archive_archive_list_date" id="archive_archive_list_date"  type="checkbox" value="check" <?php if($options['archive_archive_list_date']) echo "checked"; ?> />
											<label for="archive_archive_list_date">投稿日を表示</label>
										</div>
										<div class="mg10px-btm">
											<input name="archive_archive_list_author" id="archive_archive_list_author"  type="checkbox" value="check" <?php if($options['archive_archive_list_author']) echo "checked"; ?> />
											<label for="archive_archive_list_author">寄稿者名を表示</label>
										</div>
										<div class="mg10px-btm">
											<input name="archive_archive_list_cat" id="archive_archive_list_cat"  type="checkbox" value="check" <?php if($options['archive_archive_list_cat']) echo "checked"; ?> />
											<label for="archive_archive_list_cat">カテゴリを表示</label>
										</div>
										<div class="mg10px-btm">
											<input name="archive_archive_list_views" id="archive_archive_list_views"  type="checkbox" value="check" <?php if($options['archive_archive_list_views']) echo "checked"; ?> />
											<label for="archive_archive_list_views">ページ閲覧回数を表示</label>
										</div>

										<div class="pd10px-btm">SNSシェアカウント表示設定 :</div>
										<div class="mg15px-l">
											<div class="mg6px-btm">
											<input name="hatebu_number_after_title_archive" id="hatebu_number_after_title_archive"  type="checkbox" value="check" <?php if($options['hatebu_number_after_title_archive']) echo "checked"; ?> />
											<label for="hatebu_number_after_title_archive">はてなブックマーク数を表示</label>
											</div>
											
											<div class="mg6px-btm disp-none">
											<input name="tweet_number_after_title_archive" id="tweet_number_after_title_archive"  type="checkbox" value="check" <?php if($options['tweet_number_after_title_archive']) echo "checked"; ?> />
											<label for="tweet_number_after_title_archive">ツイート数を表示</label>
											</div>

											<div class="mg15px-btm">
											<input name="likes_number_after_title_archive" id="likes_number_after_title_archive"  type="checkbox" value="check" <?php if($options['likes_number_after_title_archive']) echo "checked"; ?> />
											<label for="likes_number_after_title_archive">Facebookの「いいね！」数を表示</label>
											</div>
										</div>

										<div id="archive_listing_post_style2">
											<span class="mg5px-r">概要文字数(ノーマル／マガジン) : </span>
											<div id="sl_archive_normal_excerpt_length" style="display:inline-block;width:300px;"></div><input type="text" value="<?php echo $archive_normal_excerpt_length; ?>" id="archive_normal_excerpt_length" name="archive_normal_excerpt_length" size="3" class="mg20px-l al-r current-value" readonly="readonly" />文字
										</div>
									</div>
								</div>
							</div>

							<div class="slide-title icon-attention mg15px-top"><?php _e('Note...', 'DigiPress'); ?></div>
							<div class="slide-content">
							※「全文」表示以外の場合は、<span class="red">投稿サムネイル(アイキャッチ画像 or 記事内の画像の自動選択)</span>が表示されます。アイキャッチ画像はWordPressの記事編集画面にて記事ごとにアップロードや指定が行えます。<br />
							※アイキャッチ画像が記事に設定されていない場合は、<span class="red">記事内で最初に見つかったimgタグの画像</span>を投稿サムネイルとして表示します。<br />
							※アイキャッチ画像も記事内に画像も見つからない場合は、DigiPressが持つ"No Image"用の画像からランダムに選ばれ表示されます。<br />
							※DigiPressの既定のNo Image用画像を変更する場合は、<span class="red">テーマフォルダの "/img/post_thumbnail/"</span>内の画像を自由に置き換えてください。
							</div>
						</div>
				</div>

				<div><h3 class="dp_set_title2 icon-triangle-right">カテゴリー別設定</h3>
					<div class="mg20px-l">
						<div class="mg15px-btm">
							<div>ノーマル(概要または抜粋)形式で表示するカテゴリー :</div>
							<input type="text" name="show_type_cat_normal" class="mg20px-l" size=30 value="<?php echo $options['show_type_cat_normal']; ?>" />
						</div>
						<div class="mg15px-btm">
							<div>ポートフォリオ1形式で表示するカテゴリー :</div>
							<input type="text" name="show_type_cat_portfolio1" class="mg20px-l" size=30 value="<?php echo $options['show_type_cat_portfolio1']; ?>" />
						</div>
						<div class="mg15px-btm">
							<div>ポートフォリオ2形式で表示するカテゴリー :</div>
							<input type="text" name="show_type_cat_portfolio2" class="mg20px-l" size=30 value="<?php echo $options['show_type_cat_portfolio2']; ?>" />
						</div>

						<div class="mg15px-btm">
							<div>マガジン形式で表示するカテゴリー :</div>
							<input type="text" name="show_type_cat_magazine1" class="mg20px-l" size=30 value="<?php echo $options['show_type_cat_magazine1']; ?>" />
						</div>

						<div class="slide-title icon-attention"><?php _e('Note...', 'DigiPress'); ?></div>
						<div class="slide-content">
						※アーカイブ共通設定と区別して、個別に特定のカテゴリーページのみ別の表示形式にする場合にその表示形式と対象の<span class="red">カテゴリーIDまたはカテゴリースラッグ</span>を指定してください。<br />
						※指定するカテゴリーが<span class="red">複数ある場合は、対象のカテゴリーIDまたはスラッグを半角カンマ「,」で区切って指定</span>してください。<br />
						※カテゴリー別に表示形式を指定しない(共通設定で統一する)場合は、未指定にして保存してください。
						</div>
					</div>
				</div>
			</dd>
	</dl>

	<!-- 保存ボタン -->
<div class="mg20px-l mg20px-btm">
<input class="button button-primary" type="submit" name="dp_save" value="<?php _e(' Save ', 'DigiPress'); ?>" />
</div>
</div>
<!--
========================================
アーカイブページ表示設定ここまで
========================================
-->

<div class="mg10px-top mg20px-btm"><input class="button close_all" type="button" name="close_all" value=" <?php _e('Close All', 'DigiPress'); ?>" /></div>

<!--
========================================
シングルページ表示設定ここから
========================================
-->
<h3 class="dp_h3 icon-menu">シングルページ表示設定</h3>
<div class="dp_box">
<p>シングルページとは、<span class="red">投稿記事、固定ページ</span>を指します。</p>
	<dl>
		<!-- アーカイブ/記事ページでの投稿日表示有無 -->
		<dt class="dp_set_title1 icon-bookmark">投稿日表示設定 :</dt>
			<dd>
			<div class="sample_img icon-camera">
				表示サンプル
				<img src="<?php echo DP_THEME_URI ?>/inc/admin/img/date_pattern.png" />
			</div>
			<div class="clearfix">
				<div class="fl-l mg15px-r mg12px-btm">
				<input name="show_pubdate_on_meta" id="show_pubdate_on_meta" type="checkbox" value="check" <?php if($options['show_pubdate_on_meta']) echo "checked"; ?> />
				<label for="show_pubdate_on_meta">投稿記事に表示する</label>
				</div>
				<div class="fl-l mg12px-btm">
				<input name="show_pubdate_on_meta_page" id="show_pubdate_on_meta_page" type="checkbox" value="check" <?php if($options['show_pubdate_on_meta_page']) echo "checked"; ?> />
				<label for="show_pubdate_on_meta_page">固定ページに表示する</label>
				</div>
			</div>

			<div id="show_date_position_div" class="mg15px-l mg15px-top mg15px-btm clearfix">
				<h4 class="dp_set_title2">シングルページでの表示位置 : </h4>
				<div class="clearfix">
					<div class="fl-l mg15px-l mg15px-r">
					<input name="show_date_under_post_title" id="show_date_under_post_title" type="checkbox" value="check" <?php if($options['show_date_under_post_title']) echo "checked"; ?> />
					<label for="show_date_under_post_title">記事上部メタエリア</label>
					</div>

					<div class="fl-l pd12px-btm">
					<input name="show_date_on_post_meta" id="show_date_on_post_meta" type="checkbox" value="check" <?php if($options['show_date_on_post_meta']) echo "checked"; ?> />
					<label for="show_date_on_post_meta">記事下部メタエリア</label>
					</div>
				</div>

				<div class="slide-title icon-attention mg12px-top cl-l"><?php _e('Note...', 'DigiPress'); ?></div>
				<div class="slide-content">
				※この設定はテーマ全体での共通設定となり、記事編集画面の<span class="red">DigiPressテーマ投稿オプションにて個別に投稿日時の表示有無を指定</span>することもできます。
				</div>
			</div>

				<div class="mg5px-top">
					<div class="mg12px-btm"><input name="date_reckon_mode" id="date_reckon_mode" type="checkbox" value="true" <?php if($options['date_reckon_mode']) echo "checked"; ?> />
					<label for="date_reckon_mode">投稿日からの起算形式で表示する (タイトル直下の日付)</label></div>
					<div class="mg12px-btm"><input name="show_last_update" id="show_last_update" type="checkbox" value="true" <?php if($options['show_last_update']) echo "checked"; ?> />
					<label for="show_last_update">最終更新日時も表示する (記事下部メタ情報の日付に追加)</label></div>
					<span class="red ft11px">※日付表示の有無は「記事メタ情報表示設定」→ "投稿日時表示" にて設定してください。</span>
				</div>
				
				<div class="slide-title icon-attention mg12px-top"><?php _e('Note...', 'DigiPress'); ?></div>
				<div class="slide-content">
				※起算形式の場合は、通常の投稿日付形式から「<span class="red">◯時間前の投稿</span>」などのように投稿日時からの起算で経過した時間を表示する形式になります。これは<span class="red">記事タイトル直下に日付を表示している場合</span>のみに有効です。<br />
				※最終更新日時は記事の最後に表示される投稿日付と一緒に表示されます。<br />
				※投稿日時と更新日時が同一(未更新)の場合は最終更新日時は表示されません。
				</div>
			</dd>
			
		<!-- アーカイブ/記事ページでの投稿者表示有無 -->
		<dt class="dp_set_title1 icon-bookmark">寄稿者名表示設定 :</dt>
			<dd>
			<div class="sample_img icon-camera">
				表示サンプル
				<img src="<?php echo DP_THEME_URI ?>/inc/admin/img/postmeta_author.png" />
			</div>
			<div class="clearfix">
				<div class="fl-l mg15px-r">
				<input name="show_author_on_meta" id="show_author_on_meta" type="checkbox" value="check" <?php if($options['show_author_on_meta']) echo "checked"; ?> />
				<label for="show_author_on_meta">投稿記事に表示する</label>
				</div>
				<div class="fl-l">
				<input name="show_author_on_meta_page" id="show_author_on_meta_page" type="checkbox" value="check" <?php if($options['show_author_on_meta_page']) echo "checked"; ?> />
				<label for="show_author_on_meta_page">固定ページに表示する</label>
				</div>
			</div>

			<div id="show_author_position_div" class="mg15px-l mg15px-top clearfix">
				<h4 class="dp_set_title2">シングルページでの表示位置 : </h4>
			
				<div class="clearfix">
					<div class="fl-l mg15px-l mg15px-r">
					<input name="show_author_under_post_title" id="show_author_under_post_title" type="checkbox" value="check" <?php if($options['show_author_under_post_title']) echo "checked"; ?> />
					<label for="show_author_under_post_title">記事上部メタエリア</label>
					</div>

					<div class="fl-l pd12px-btm">
					<input name="show_author_on_post_meta" id="show_author_on_post_meta" type="checkbox" value="check" <?php if($options['show_author_on_post_meta']) echo "checked"; ?> />
					<label for="show_author_on_post_meta">記事下部メタエリア</label>
					</div>
				</div>

				<div class="slide-title icon-attention mg12px-top cl-l"><?php _e('Note...', 'DigiPress'); ?></div>
				<div class="slide-content">
				※この設定はテーマ全体での共通設定となり、記事編集画面の<span class="red">DigiPressテーマ投稿オプションにて個別に寄稿者(投稿者)の表示有無を指定</span>することもできます。<br />
				※寄稿者名の先頭にアバターを表示する場合は、<span class="red">「サイト動作一般設定」→「標準化設定」の "記事メタ情報の寄稿者名にアバターを表示する" にチェック</span>をしてください。
				</div>
			</div>
			</dd>
		
		<!-- アーカイブ/記事ページでの閲覧回数表示有無 -->
		<dt class="dp_set_title1 icon-bookmark">ページ閲覧回数表示設定 :</dt>
			<dd>
			<div class="sample_img icon-camera">
				表示サンプル
				<img src="<?php echo DP_THEME_URI ?>/inc/admin/img/postmeta_views.png" />
			</div>
			<div class="clearfix">
				<div class="fl-l mg15px-r">
				<input name="show_views_on_meta" id="show_views_on_meta" type="checkbox" value="check" <?php if($options['show_views_on_meta']) echo "checked"; ?> />
				<label for="show_views_on_meta">投稿記事に表示する</label>
				</div>
			</div>

			<div id="show_views_position_div" class="mg15px-l mg15px-top clearfix">
				<h4 class="dp_set_title2">シングルページでの表示位置 : </h4>

				<div class="clearfix">
					<div class="fl-l mg15px-l mg15px-r">
					<input name="show_views_under_post_title" id="show_views_under_post_title" type="checkbox" value="check" <?php if($options['show_views_under_post_title']) echo "checked"; ?> />
					<label for="show_views_under_post_title">記事上部メタエリア</label>
					</div>

					<div class="fl-l pd12px-btm">
					<input name="show_views_on_post_meta" id="show_views_on_post_meta" type="checkbox" value="check" <?php if($options['show_views_on_post_meta']) echo "checked"; ?> />
					<label for="show_views_on_post_meta">記事下部メタエリア</label>
					</div>
				</div>

				<div class="slide-title icon-attention mg12px-top cl-l"><?php _e('Note...', 'DigiPress'); ?></div>
				<div class="slide-content">
				※ページ閲覧回数の表示対象は記事ページのみで、<span class="red">固定ページやカスタム投稿タイプの単体ページは対象外</span>です。<br />
				※この設定はテーマ全体での共通設定となり、記事編集画面の<span class="red">DigiPressテーマ投稿オプションにて個別に閲覧回数の表示有無を指定</span>することもできます。
				</div>
			</div>
			</dd>

		<!-- アーカイブ/記事ページでのカテゴリ表示有無 -->
		<dt class="dp_set_title1 icon-bookmark">カテゴリ表示設定 :</dt>
			<dd>
			<div class="sample_img icon-camera">
				表示サンプル
				<img src="<?php echo DP_THEME_URI ?>/inc/admin/img/postmeta_category.png" />
			</div>
			<div class="clearfix">
				<div class="fl-l mg15px-r">
				<input name="show_cat_on_meta" id="show_cat_on_meta" type="checkbox" value="check" <?php if($options['show_cat_on_meta']) echo "checked"; ?> />
				<label for="show_cat_on_meta">投稿記事に表示する</label>
				</div>
			</div>

			<div id="show_cat_position_div" class="mg15px-l mg15px-top clearfix">
				<h4 class="dp_set_title2">シングルページでの表示位置 : </h4>
				
				<div class="clearfix">
					<div class="fl-l mg15px-l mg15px-r">
					<input name="show_cat_under_post_title" id="show_cat_under_post_title" type="checkbox" value="check" <?php if($options['show_cat_under_post_title']) echo "checked"; ?> />
					<label for="show_cat_under_post_title">記事上部メタエリア</label>
					</div>

					<div class="fl-l pd12px-btm">
					<input name="show_cat_on_post_meta" id="show_cat_on_post_meta" type="checkbox" value="check" <?php if($options['show_cat_on_post_meta']) echo "checked"; ?> />
					<label for="show_cat_on_post_meta">記事下部メタエリア</label>
					</div>
				</div>

				<div class="slide-title icon-attention mg12px-top cl-l"><?php _e('Note...', 'DigiPress'); ?></div>
				<div class="slide-content">
				※記事一覧(アーカイブ形式)でカテゴリが表示される形式は、「<span class="red">概要または抜粋</span>」にて記事一覧を表示しているときのみです。<br />
				※カテゴリの表示対象は<span class="red">固定ページやカスタム投稿タイプの単体ページは対象外</span>です。<br />
				※この設定はテーマ全体での共通設定となり、記事編集画面の<span class="red">DigiPressテーマ投稿オプションにて個別にカテゴリの表示有無を指定</span>することもできます。
				</div>
			</div>
			</dd>

		<!-- 記事ページでのタグ表示有無 -->
		<dt class="dp_set_title1 icon-bookmark">タグリンク表示設定 :</dt>
			<dd>
			<div class="sample_img icon-camera">
				表示サンプル
				<img src="<?php echo DP_THEME_URI ?>/inc/admin/img/postmeta_tag.png" />
			</div>
			<div class="clearfix">
				<div class="fl-l mg12px-btm">
				<input name="show_tags" id="show_tags" type="checkbox" value="check" <?php if($options['show_tags']) echo "checked"; ?> />
				<label for="show_tags">記事下部に表示する</label>
				</div>

				<div class="slide-title icon-attention mg12px-top cl-l"><?php _e('Note...', 'DigiPress'); ?></div>
				<div class="slide-content">
				※記事一覧(アーカイブ形式)ではタグリンクは表示されません。<br />
				※記事のタグ表示は固定ページやカスタム投稿タイプのページでは無効です。<br />
				※この設定はテーマ全体での共通設定となり、記事編集画面の<span class="red">DigiPressテーマ投稿オプションにて個別にタグの表示有無を指定</span>することもできます。
				</div>
			</div>
			</dd>

		<!-- 記事を読む時間 -->
		<dt class="dp_set_title1 icon-bookmark">記事閲覧時間の目安表示 :</dt>
			<dd class="clearfix">
				<div class="sample_img icon-camera">
				表示サンプル
				<img src="<?php echo DP_THEME_URI ?>/inc/admin/img/time_for_reading.png" />
				</div>
				<div class="mg15px-r mg5px-top">
				<input name="time_for_reading" id="time_for_reading" type="checkbox" value="true" <?php if($options['time_for_reading']) echo "checked"; ?> />
				<label for="time_for_reading">表示する</label>
				</div>
				
				<div class="slide-title icon-attention mg12px-top"><?php _e('Note...', 'DigiPress'); ?></div>
				<div class="slide-content">
				※1分間で読める文字数を600文字として換算表示します。
				</div>
			</dd>

		<!-- 記事ページでのソーシャルサービスボタン表示有無 -->
		<dt class="dp_set_title1 icon-bookmark">
		ソーシャルサービス連携ボタン表示設定 :
		</dt>
			<dd>
			<div class="sample_img icon-camera">
				表示サンプル
				<img src="<?php echo DP_THEME_URI ?>/inc/admin/img/sns_btn.png" />
			</div>
			<div class="clearfix mg12px-top">
				<div class="fl-l mg15px-r">
				<input name="sns_button_under_title" id="sns_button_under_title" type="checkbox" value="title" <?php if($options['sns_button_under_title']) echo "checked"; ?> />
				<label for="sns_button_under_title">記事上部メタエリアに表示する</label>
				</div>
				<div class="fl-l">
				<input name="sns_button_on_meta" id="sns_button_on_meta" type="checkbox" value="meta" <?php if($options['sns_button_on_meta']) echo "checked"; ?> />
				<label for="sns_button_on_meta">記事下部メタエリアに表示する</label>
				</div>
				
			</div>
			
			<div id="target_sns_services" class="mg15px-top mg15px-l clearfix">
				<div class="mg15px-btm ">表示形式 :
					<select name="sns_button_type" size="1">
						<option value="standard" <?php if($options['sns_button_type'] == 'standard') echo "selected=\"selected\""; ?>>スタンダード</option>
						<option value="box" <?php if($options['sns_button_type'] == 'box') echo "selected=\"selected\""; ?>>ボックス</option>
						<option value="original1" <?php if($options['sns_button_type'] == 'original1') echo "selected=\"selected\""; ?>>オリジナル</option>
					</select>
				</div>

			
				<input name="show_google_button" id="show_google_button" type="checkbox" value="check" <?php if($options['show_google_button']) echo "checked"; ?> />
				<label for="show_google_button" id="google_btn" class="pd15px-r">
				Google+1</label>
				<input name="show_twitter_button" id="show_twitter_button" type="checkbox" value="check" <?php if($options['show_twitter_button']) echo "checked"; ?> />
				<label for="show_twitter_button" id="twitter_btn" class="pd15px-r">
				Twitter</label>

				<input name="show_facebook_button" id="show_facebook_button" type="checkbox" value="check" <?php if($options['show_facebook_button']) echo "checked"; ?> />
				<label for="show_facebook_button" id="facebook_btn">
				Facebook</label>
				( <input name="show_facebook_button_w_share" id="show_facebook_button_w_share" type="checkbox" value="check" <?php if($options['show_facebook_button_w_share']) echo "checked"; ?> />
				<label for="show_facebook_button_w_share" class="pd15px-r">
				シェアボタンも表示 ) </label>

				<input name="show_pocket_button" id="show_pocket_button" type="checkbox" value="check" <?php if($options['show_pocket_button']) echo "checked"; ?> />
				<label for="show_pocket_button" id="pocket_btn" class="pd15px-r">
				Pocket</label>
				<input name="show_feedly_button" id="show_feedly_button" type="checkbox" value="check" <?php if($options['show_feedly_button']) echo "checked"; ?> />
				<label for="show_feedly_button" id="show_feedly_button" class="pd15px-r">
				feedly</label>
				<input name="show_hatena_button" id="show_hatena_button" type="checkbox" value="check" <?php if($options['show_hatena_button']) echo "checked"; ?> />
				<label for="show_hatena_button" id="hatena_btn" class="pd15px-r">
				はてなブックマーク</label>
				<input name="show_mixi_button" id="show_mixi_button" type="checkbox" value="check" <?php if($options['show_mixi_button']) echo "checked"; ?> />
				<label for="show_mixi_button" id="mixi_btn">
				mixiイイネ！</label> *<a href="http://developer.mixi.co.jp/connect/mixi_plugin/mixi_check/mixicheck/#add_service" target="_blank">チェックキー</a>:<input type="text" name="mixi_accept_key" id="mixi_accept_key"  class="mg15px-r" size="15" value="<?php echo($options['mixi_accept_key']); ?>" />
				<input name="show_evernote_button" id="show_evernote_button" type="checkbox" value="check" <?php if($options['show_evernote_button']) echo "checked"; ?> />
				<label for="show_evernote_button" id="evernote_btn" class="pd15px-r">
				Evernote</label>
				<input name="show_tumblr_button" id="show_tumblr_button" type="checkbox" value="check" <?php if($options['show_tumblr_button']) echo "checked"; ?> />
				<label for="show_tumblr_button" id="tumblr_btn" class="pd15px-r">
				Tumblr</label>
				<input name="show_line_button" id="show_line_button" type="checkbox" value="check" <?php if($options['show_line_button']) echo "checked"; ?> />
				<label for="show_line_button" id="line_btn" class="pd15px-r">
				LINE</label>
			</div>
			
			<div class="slide-title icon-attention mg12px-top"><?php _e('Note...', 'DigiPress'); ?></div>
			<div class="slide-content">
			※投稿ページ、固定ページでのSNS連携ボタンの表示有無は、投稿の編集画面、および固定ページの編集画面の「DigiPressテーマ用投稿オプション」にて個別に指定してください。<br />
			※「mixiイイネ！」ボタンを表示するには、事前にmixiのアカウントが必要です。<br />さらに、mixiの<a href="http://developer.mixi.co.jp/connect/developer_registration/" target="_blank">開発者登録</a>を行い、「<a href="https://sap.mixi.jp/home.pl" target="_blank">Partner Dashboard</a>」にて、”mixi Plugin”からサービスを追加し、チェックキーを取得する必要があります。<br />
			※「LINEで送る」ボタンは、スマートフォンサイズ(表示幅600ピクセル以下)にて表示されます。<br />
			※表示スタイルを「オリジナル」にした場合は、Twitter, Facebook, Google+, Pocket, はてなブックマーク, Feedly のシェアボタンのみが対象となります。
			</div>
			</dd>

		<dt class="dp_set_title1 icon-bookmark">アイキャッチ表示設定 :</dt>
			<dd class="clearfix">
				<div class="sample_img icon-camera">
				表示サンプル
				<img src="<?php echo DP_THEME_URI ?>/inc/admin/img/show_eyecatch_first.png" />
				</div>
				<div class="mg15px-r mg5px-top">
				<input name="show_eyecatch_first" id="show_eyecatch_first" type="checkbox" value="true" <?php if($options['show_eyecatch_first']) echo "checked"; ?> />
				<label for="show_eyecatch_first">アイキャッチ画像がある場合は自動的に記事先頭に表示する</label>
				</div>
				
				<div class="slide-title icon-attention mg12px-top"><?php _e('Note...', 'DigiPress'); ?></div>
				<div class="slide-content">
				※記事の投稿画面にてアイキャッチ画像を指定した場合に、<span class="red">本文の先頭(タイトル直下)に自動的にそのアイキャッチ画像を表示</span>させる場合に指定してください。<br />
				※このオプションは固定ページやカスタム投稿タイプの単体ページの場合は対象外です。
				</div>
			</dd>

			<dt class="dp_set_title1 icon-bookmark">コメント欄 :</dt>
				<dd class="clearfix">
					<table class="dp_table1">
						<tbody>
							<tr>
								<td>コメント一覧エリアタイトル : 
									<div class="sample_img icon-camera mg5px-btm">表示サンプル<img src="<?php echo DP_THEME_URI ?>/inc/admin/img/comments_main_title.png" /></div>
								</td>
								<td><input type="text" name="comments_main_title" id="comments_main_title" size="48" value="<?php echo($options['comments_main_title']); ?>" /></td>
							</tr>
							<tr>
								<td>コメントフォームタイトル : 
									<div class="sample_img icon-camera mg5px-btm">表示サンプル<img src="<?php echo DP_THEME_URI ?>/inc/admin/img/comment_form_title.png" /></div>
								</td>
								<td><input type="text" name="comment_form_title" id="comment_form_title" size="48" value="<?php echo($options['comment_form_title']); ?>" /></td>
							</tr>
						</tbody>
					</table>
				</dd>


			<!-- Facebookコメント欄 -->
			<dt class="dp_set_title1 icon-bookmark">Facebookコメント欄 :</dt>
				<dd class="clearfix">
					<div class="sample_img icon-camera">
					表示サンプル
					<img src="<?php echo DP_THEME_URI ?>/inc/admin/img/fbcomment.png" />
					</div>
					<div class="fl-l mg15px-r mg5px-top">
					<input name="facebookcomment" id="facebookcomment" type="checkbox" value="true" <?php if($options['facebookcomment']) echo "checked"; ?> />
					<label for="facebookcomment">記事ページに表示する</label>
					</div>
					<div class="mg15px-r pd4px-top mg18px-btm">
					<input name="facebookcomment_page" id="facebookcomment_page" type="checkbox" value="true" <?php if($options['facebookcomment_page']) echo "checked"; ?> />
					<label for="facebookcomment_page">固定ページにに表示する</label>
					</div>
					<div class="clearfix">
					コメント表示件数 : 
					<input type="text" size=2 style="text-align:right;" id="number_fb_comment" name="number_fb_comment" value="<?php echo ($options['number_fb_comment']) ? $options['number_fb_comment'] : "10"; ?>" />件
					</div>

					<div class="mg15px-top mg15px-l" id="fb_comments_title">
						<div class="mg12px-btm">
						タイトル : <input type="text" name="fb_comments_title" id="fb_comments_title" size="60" value="<?php echo($options['fb_comments_title']); ?>" />
						</div>
					</div>
				</dd>
			
			<!-- 関連記事の表示 -->
			<dt class="dp_set_title1 icon-bookmark">関連記事・その他の記事表示 :</dt>
				<dd class="clearfix">
					記事の最後に関連記事または同一カテゴリー内のその他の記事を表示します。
					<div class="sample_img icon-camera">
					表示サンプル
					<img src="<?php echo DP_THEME_URI ?>/inc/admin/img/related_posts.png" />
					</div>
					<div class="mg15px-r mg5px-top">
					<input name="show_related_posts" id="show_related_posts" type="checkbox" value="true" <?php if($options['show_related_posts']) echo "checked"; ?> />
					<label for="show_related_posts">表示する</label>
					</div>
					
					<div class="mg15px-top mg15px-l" id="related_posts_params">
						<table class="dp_table1">
							<tbody>
								<tr>
									<td>タイトル :</td>
									<td><input type="text" name="related_posts_title" id="related_posts_title" size="60" value="<?php echo($options['related_posts_title']); ?>" /></td>
								</tr>
								<tr>
									<td>表示対象 :</td>
									<td>
										<select name="related_posts_target" size=1 style="position:relative;top:8px;">
							<option value="1" <?php if($options['related_posts_target'] == 1) echo "selected=\"selected\""; ?>>同じタグを持つ関連記事</option>
							<option value="2" <?php if($options['related_posts_target'] == 2) echo "selected=\"selected\""; ?>>同一カテゴリーの投稿記事(投稿日付順)</option>
							<option value="3" <?php if($options['related_posts_target'] == 3) echo "selected=\"selected\""; ?>>同一カテゴリーの投稿記事(ランダム)</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>表示スタイル :</td>
									<td>
										<input name="related_posts_style" id="related_posts_style1" type="radio" value="vertical" <?php if($options['related_posts_style'] != 'horizon') echo "checked"; ?> /><label for="related_posts_style1" class="pd15px-r"> スタンダード </label> 
										<input name="related_posts_style" id="related_posts_style2" type="radio" value="horizon" <?php if($options['related_posts_style'] == 'horizon') echo "checked"; ?> /><label for="related_posts_style2" class="pd15px-r"> ポートフォリオ </label>
									</td>
								</tr>
								<tr>
									<td>関連記事表示件数 :</td>
									<td>
										<input type="number" autocomplete="on" size=8 min=0 name="number_related_posts" id="number_related_posts" value="<?php echo $options['number_related_posts']; ?>" style="width:60px;" /> 
									</td>
								</tr>
								<tr>
									<td>サムネイル表示 :</td>
									<td>
										<input name="related_posts_thumbnail" id="related_posts_thumbnail" type="checkbox" value="true" <?php if($options['related_posts_thumbnail']) echo "checked"; ?> /><label for="related_posts_thumbnail">表示する</label>
									</td>
								</tr>
								<tr>
									<td>記事の投稿カテゴリー :</td>
									<td>
										<input name="related_posts_category" id="related_posts_category" type="checkbox" value="true" <?php if($options['related_posts_category']) echo "checked"; ?> /><label for="related_posts_category">表示する</label>
									</td>
								</tr>
							</tbody>
						</table>
						<div class="slide-title icon-attention mg12px-top"><?php _e('Note...', 'DigiPress'); ?></div>
						<div class="slide-content">
						※対象が関連記事の表示は、記事に付けられたタグを元に同じタグを持つものを検出して表示します。<br />
						※対象が同一カテゴリーの投稿記事の場合は、表示中の投稿が属するカテゴリーに投稿された他の投稿記事を表示します。
						</div>
					</div>
				</dd>

		<dt class="dp_set_title1 icon-bookmark">前後記事のナビゲーション :</dt>
			<dd class="clearfix">
				<div class="sample_img icon-camera">表示サンプル
				<img src="<?php echo DP_THEME_URI ?>/inc/admin/img/next_prev_navi.png" />
				</div>
				<div class="mg15px-r mg5px-top">
				<input name="next_prev_in_same_cat" id="next_prev_in_same_cat" type="checkbox" value="true" <?php if($options['next_prev_in_same_cat']) echo "checked"; ?> />
				<label for="next_prev_in_same_cat">同一カテゴリーの記事を対象とする</label>
				</div>
				
				<div class="slide-title icon-attention mg12px-top"><?php _e('Note...', 'DigiPress'); ?></div>
				<div class="slide-content">
				※記事ページの下に表示される隣接する前後記事へのリンクを表示記事と同じ投稿カテゴリーの記事のみに絞リ込む場合に選択します。<br />
				※規定値は絞り込みをせずに投稿順の前後の記事を対象とします。
				</div>
			</dd>
	</dl>

	<!-- 保存ボタン -->
<div class="mg20px-l mg20px-btm">
<input class="button button-primary" type="submit" name="dp_save" value="<?php _e(' Save ', 'DigiPress'); ?>" />
</div>
</div>
<!--
========================================
シングルページ表示設定ここまで
========================================
-->

<div class="mg10px-top mg20px-btm"><input class="button close_all" type="button" name="close_all" value=" <?php _e('Close All', 'DigiPress'); ?>" /></div>


<!--
========================================
アクセス解析用コード設定ここから
========================================
-->
<h3 class="dp_h3 icon-menu">アクセス解析コード設定</h3>
<div class="dp_box">
	<dl>
		<!-- サイドバーのカテゴリ投稿数表示有無 -->
		<dt class="dp_set_title1 icon-bookmark">
		アクセス解析コード :
		</dt>
			<dd>
			<div class=" mg12px-top">
			<textarea name="tracking_code" cols="95%" rows="5"><?php echo($options['tracking_code']); ?></textarea><br />
			<input name="no_track_admin" id="no_track_admin" type="checkbox" value="check" <?php if($options['no_track_admin']) echo "checked"; ?> />
			<label for="no_track_admin">管理者自身(ログイン中)はカウントしない</label>
			
			<div class="slide-title icon-attention mg12px-top"><?php _e('Note...', 'DigiPress'); ?></div>
			<div class="slide-content">
			※アクセス解析コードを<span class="red">使用しない場合は、空の状態で保存</span>してください。<br />
			※チェックボックスにチェックを入れると、ログイン中の管理者のサイトへのアクセスはカウントされずスルーされます。
			</div>
			
			</div>
			</dd>
	</dl>

	<!-- 保存ボタン -->
<div class="mg20px-l mg20px-btm">
<input class="button button-primary" type="submit" name="dp_save" value="<?php _e(' Save ', 'DigiPress'); ?>" />
</div>
</div>

<div class="mg10px-top mg20px-btm"><input class="button close_all" type="button" name="close_all" value=" <?php _e('Close All', 'DigiPress'); ?>" /></div>

<div><input class="button" type="submit" name="dp_reset_control" value="<?php _e(' Restore Default ', 'DigiPress'); ?>" onclick="return confirm('現在の設定は全てクリアされます。初期状態に戻しますか？')" />
</div>
<!--
========================================
アクセス解析用コード設定ここまで
========================================
-->
</form>
</div>

</div>
