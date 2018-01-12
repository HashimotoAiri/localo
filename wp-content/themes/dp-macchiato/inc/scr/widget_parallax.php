<?php
/*******************************************************
* Parallax scrolling widget
*******************************************************/
class DP_PARALLAX_WIDGET extends WP_Widget {
	/**
	 * Private params
	 *
	 */
	private $text_domain 	= "DigiPress";

	function DP_PARALLAX_WIDGET() {
		$widget_opts = array('classname'	=> 'DP_PARALLAX_WIDGET', 
							 'description'	=> __('Show the parallax scrolling contents.','DigiPress') );
		$control_opts = array('width' => 400, 'height' => 350);
		$this->__construct('DP_PARALLAX_WIDGET', __('DP - Parallax Content','DigiPress'), $widget_opts, $control_opts);
	}

	function form($instance) {
		$instance = wp_parse_args((array)$instance, array(
														  'title' 		=> '',
														  'title_color'=> '#444444',
														  'title_size'	=> 26,
														  'title_enter_pos' => 'enter top',
														  'title_scale'	=> 'none',
														  'title_roll'	=> 'none',
														  'text'		=> '',
														  'text_color'	=> '#666666',
														  'text_size'	=> 14,
														  'text_enter_pos' => 'bottom',
														  'text_scale'	=> 'none',
														  'text_roll'	=> 'none',
														  'bg_color'	=> '',
														  'bg_img_url'	=> '',
														  'bg_brightness' => 100,
														  'bg_video_url'=> '',
														  'img_url'		=> '',
														  'img_pos'		=> 'right',
														  'img_enter_pos'=> 'right',
														  'img_scale'	=> 'none',
														  'img_roll'	=> 'none',
														  'text_shadow' => '',
														  'btn_text'	=> '',
														  'btn_size'	=> 18,
														  'btn_color'	=> '',
														  'btn_url'		=> '',
														  'btn_enter_pos'=> '',
														  'btn_scale'	=> '',
														  'btn_roll'	=> '',
														  'contents' 	=> '',
														  'show_target'	=> '',
														  'target_id'	=> '' )
		);

		$img_pos_form 		= '';
		$show_target_form	= '';

		$wp_editor_setings = array(
				'wpautop' => true,
				'textarea_rows' => 7);
		$def_title_color = '#444444';
		$def_title_size	= 26;
		$def_text_color = '#666666';
		$def_text_size	= 14;
		$def_btn_size	= 18;
		$def_bg_brightness	= 100;

		$title		= stripslashes($instance['title']);
		$title_size = mb_convert_kana($instance['title_size'],"n");
		if (!is_numeric($instance['title_size']) || empty($instance['title_size'])) {
			$title_size = $def_title_size;
		}
		$title_color	= $instance['title_color'];
		$title_enter_pos= $instance['title_enter_pos'];
		$title_scale 	= $instance['title_scale'];
		$title_roll 	= $instance['title_roll'];

		$text		= stripslashes($instance['text']);
		$text_size = mb_convert_kana($instance['text_size'],"n");
		if (!is_numeric($instance['text_size']) || empty($instance['text_size'])) {
			$text_size = $def_text_size;
		}
		$text_color	= $instance['text_color'];
		$text_enter_pos= $instance['text_enter_pos'];
		$text_scale	= $instance['text_scale'];
		$text_roll	= $instance['text_roll'];

		$bg_color	= $instance['bg_color'];
		$bg_img_url	= $instance['bg_img_url'];
		$bg_brightness = $instance['bg_brightness'];
		if (!is_numeric($instance['bg_brightness']) || empty($instance['bg_brightness'])) {
			$bg_brightness = $def_bg_brightness;
		}
		$bg_video_url	= $instance['bg_video_url'];
		$text_shadow= $instance['text_shadow'];

		$img_url	= $instance['img_url'];
		$img_pos	= $instance['img_pos'];
		$img_enter_pos	= $instance['img_enter_pos'];
		$img_scale	= $instance['img_scale'];
		$img_roll	= $instance['img_roll'];
		

		$btn_text	= stripslashes($instance['btn_text']);
		$btn_size = mb_convert_kana($instance['btn_size'],"n");
		if (!is_numeric($btn_size)) {
			$btn_size = $def_btn_size;
		}
		$btn_color	= $instance['btn_color'];
		$btn_url	= $instance['btn_url'];
		$btn_enter_pos	= $instance['btn_enter_pos'];
		$btn_scale	= $instance['btn_scale'];
		$btn_roll	= $instance['btn_roll'];
		
		$contents	= stripslashes($instance['contents']);
		
		$show_target= $instance['show_target'];
		$target_id	= $instance['target_id'];


		$title_name	= $this->get_field_name('title');
		$title_id	= $this->get_field_id('title');
		$title_color_name	= $this->get_field_name('title_color');
		$title_color_id		= $this->get_field_id('title_color');
		$title_size_name	= $this->get_field_name('title_size');
		$title_size_id		= $this->get_field_id('title_size');
		$title_enter_pos_name	= $this->get_field_name('title_enter_pos');
		$title_enter_pos_id		= $this->get_field_id('title_enter_pos');
		$title_scale_name	= $this->get_field_name('title_scale');
		$title_scale_id		= $this->get_field_id('title_scale');
		$title_roll_name	= $this->get_field_name('title_roll');
		$title_roll_id		= $this->get_field_id('title_roll');

		$text_name	= $this->get_field_name('text');
		$text_id	= $this->get_field_id('text');
		$text_color_name	= $this->get_field_name('text_color');
		$text_color_id		= $this->get_field_id('text_color');
		$text_size_name		= $this->get_field_name('text_size');
		$text_size_id		= $this->get_field_id('text_size');
		$text_enter_pos_name= $this->get_field_name('text_enter_pos');
		$text_enter_pos_id	= $this->get_field_id('text_enter_pos');
		$text_scale_name= $this->get_field_name('text_scale');
		$text_scale_id	= $this->get_field_id('text_scale');
		$text_roll_name	= $this->get_field_name('text_roll');
		$text_roll_id	= $this->get_field_id('text_roll');

		$btn_color_name	= $this->get_field_name('btn_color');
		$btn_color_id	= $this->get_field_id('btn_color');
		$btn_text_name	= $this->get_field_name('btn_text');
		$btn_text_id	= $this->get_field_id('btn_text');
		$btn_size_name	= $this->get_field_name('btn_size');
		$btn_size_id	= $this->get_field_id('btn_size');
		$btn_url_name	= $this->get_field_name('btn_url');
		$btn_url_id		= $this->get_field_id('btn_url');
		$btn_enter_pos_name	= $this->get_field_name('btn_enter_pos');
		$btn_enter_pos_id	= $this->get_field_id('btn_enter_pos');
		$btn_scale_name	= $this->get_field_name('btn_scale');
		$btn_scale_id	= $this->get_field_id('btn_scale');
		$btn_roll_name	= $this->get_field_name('btn_roll');
		$btn_roll_id	= $this->get_field_id('btn_roll');

		$img_url_name	= $this->get_field_name('img_url');
		$img_url_id		= $this->get_field_id('img_url');
		$img_pos_name	= $this->get_field_name('img_pos');
		$img_pos_id		= $this->get_field_id('img_pos');
		$img_enter_pos_name	= $this->get_field_name('img_enter_pos');
		$img_enter_pos_id	= $this->get_field_id('img_enter_pos');
		$img_scale_name	= $this->get_field_name('img_scale');
		$img_scale_id	= $this->get_field_id('img_scale');
		$img_roll_name	= $this->get_field_name('img_roll');
		$img_roll_id	= $this->get_field_id('img_roll');

		$bg_img_url_name	= $this->get_field_name('bg_img_url');
		$bg_img_url_id		= $this->get_field_id('bg_img_url');
		$bg_color_name		= $this->get_field_name('bg_color');
		$bg_color_id		= $this->get_field_id('bg_color');
		$bg_brightness_name	= $this->get_field_name('bg_brightness');
		$bg_brightness_id	= $this->get_field_id('bg_brightness');
		$bg_video_url_name	= $this->get_field_name('bg_video_url');
		$bg_video_url_id	= $this->get_field_id('bg_video_url');
		$text_shadow_name	= $this->get_field_name('text_shadow');
		$text_shadow_id		= $this->get_field_id('text_shadow');

		$contents_name	= $this->get_field_name('contents');
		$contents_id	= $this->get_field_id('contents');
		$show_target_name	= $this->get_field_name('show_target');
		$show_target_id		= $this->get_field_id('show_target');
		$target_id_name	= $this->get_field_name('target_id');
		$target_id_id	= $this->get_field_id('target_id');

		// Image position
		$arr_img_pos = array('left','right','top','bottom');
		foreach ($arr_img_pos as $val) {
			if ($val === $img_pos) {
				$img_pos_form .= '<option value="'.$val.'" selected>'.__($val,'DigiPress').'</option>';
			} else {
				$img_pos_form .= '<option value="'.$val.'">'.__($val,'DigiPress').'</option>';
			}
		}
		$img_pos_form = '<select id="'.$img_pos_id.'" name="'.$img_pos_name.'" size=1>'.$img_pos_form.'</select>';

		// Enter position
		$arr_enter_pos = array('none', 'enter left','enter right','enter top','enter bottom');
		foreach ($arr_enter_pos as $val) {
			if ($val === $title_enter_pos) {
				$title_enter_pos_form .= '<option value="'.$val.'" selected>'.__($val,'DigiPress').'</option>';
			} else {
				$title_enter_pos_form .= '<option value="'.$val.'">'.__($val,'DigiPress').'</option>';
			}
			if ($val === $text_enter_pos) {
				$text_enter_pos_form .= '<option value="'.$val.'" selected>'.__($val,'DigiPress').'</option>';
			} else {
				$text_enter_pos_form .= '<option value="'.$val.'">'.__($val,'DigiPress').'</option>';
			}
			if ($val === $img_enter_pos) {
				$img_enter_pos_form .= '<option value="'.$val.'" selected>'.__($val,'DigiPress').'</option>';
			} else {
				$img_enter_pos_form .= '<option value="'.$val.'">'.__($val,'DigiPress').'</option>';
			}
			if ($val === $btn_enter_pos) {
				$btn_enter_pos_form .= '<option value="'.$val.'" selected>'.__($val,'DigiPress').'</option>';
			} else {
				$btn_enter_pos_form .= '<option value="'.$val.'">'.__($val,'DigiPress').'</option>';
			}
		}
		$title_enter_pos_form = '<select id="'.$title_enter_pos_id.'" name="'.$title_enter_pos_name.'" size=1>'.$title_enter_pos_form.'</select>';
		$text_enter_pos_form = '<select id="'.$text_enter_pos_id.'" name="'.$text_enter_pos_name.'" size=1>'.$text_enter_pos_form.'</select>';
		$img_enter_pos_form = '<select id="'.$img_enter_pos_id.'" name="'.$img_enter_pos_name.'" size=1>'.$img_enter_pos_form.'</select>';
		$btn_enter_pos_form = '<select id="'.$btn_enter_pos_id.'" name="'.$btn_enter_pos_name.'" size=1>'.$btn_enter_pos_form.'</select>';

		// Scale type
		$arr_scale = array('none','scale up 20%','scale down 20%');
		foreach ($arr_scale as $val) {
			if ($val === $title_scale) {
				$title_scale_form .= '<option value="'.$val.'" selected>'.__($val,'DigiPress').'</option>';
			} else {
				$title_scale_form .= '<option value="'.$val.'">'.__($val,'DigiPress').'</option>';
			}
			if ($val === $text_scale) {
				$text_scale_form .= '<option value="'.$val.'" selected>'.__($val,'DigiPress').'</option>';
			} else {
				$text_scale_form .= '<option value="'.$val.'">'.__($val,'DigiPress').'</option>';
			}
			if ($val === $img_scale) {
				$img_scale_form .= '<option value="'.$val.'" selected>'.__($val,'DigiPress').'</option>';
			} else {
				$img_scale_form .= '<option value="'.$val.'">'.__($val,'DigiPress').'</option>';
			}
			if ($val === $btn_scale) {
				$btn_scale_form .= '<option value="'.$val.'" selected>'.__($val,'DigiPress').'</option>';
			} else {
				$btn_scale_form .= '<option value="'.$val.'">'.__($val,'DigiPress').'</option>';
			}
		}
		$title_scale_form = '<select id="'.$title_scale_id.'" name="'.$title_scale_name.'" size=1>'.$title_scale_form.'</select>';
		$text_scale_form = '<select id="'.$text_scale_id.'" name="'.$text_scale_name.'" size=1>'.$text_scale_form.'</select>';
		$img_scale_form = '<select id="'.$img_scale_id.'" name="'.$img_scale_name.'" size=1>'.$img_scale_form.'</select>';
		$btn_scale_form = '<select id="'.$btn_scale_id.'" name="'.$btn_scale_name.'" size=1>'.$btn_scale_form.'</select>';

		// Rolling type
		$arr_roll = array('none','roll 20deg','roll -20deg');
		foreach ($arr_roll as $val) {
			if ($val === $title_roll) {
				$title_roll_form .= '<option value="'.$val.'" selected>'.__($val,'DigiPress').'</option>';
			} else {
				$title_roll_form .= '<option value="'.$val.'">'.__($val,'DigiPress').'</option>';
			}
			if ($val === $text_roll) {
				$text_roll_form .= '<option value="'.$val.'" selected>'.__($val,'DigiPress').'</option>';
			} else {
				$text_roll_form .= '<option value="'.$val.'">'.__($val,'DigiPress').'</option>';
			}
			if ($val === $img_roll) {
				$img_roll_form .= '<option value="'.$val.'" selected>'.__($val,'DigiPress').'</option>';
			} else {
				$img_roll_form .= '<option value="'.$val.'">'.__($val,'DigiPress').'</option>';
			}
			if ($val === $btn_roll) {
				$btn_roll_form .= '<option value="'.$val.'" selected>'.__($val,'DigiPress').'</option>';
			} else {
				$btn_roll_form .= '<option value="'.$val.'">'.__($val,'DigiPress').'</option>';
			}
		}
		$title_roll_form = '<select id="'.$title_roll_id.'" name="'.$title_roll_name.'" size=1>'.$title_roll_form.'</select>';
		$text_roll_form = '<select id="'.$text_roll_id.'" name="'.$text_roll_name.'" size=1>'.$text_roll_form.'</select>';
		$img_roll_form = '<select id="'.$img_roll_id.'" name="'.$img_roll_name.'" size=1>'.$img_roll_form.'</select>';
		$btn_roll_form = '<select id="'.$btn_roll_id.'" name="'.$btn_roll_name.'" size=1>'.$btn_roll_form.'</select>';

		// Show target
		$arr_show_target = array('nothing','top page','post','page');
		foreach ($arr_show_target as $val) {
			if ($val === $show_target) {
				$show_target_form .= '<option value="'.$val.'" selected>'.__($val,'DigiPress').'</option>';
			} else {
				$show_target_form .= '<option value="'.$val.'">'.__($val,'DigiPress').'</option>';
			}
		}
		$show_target_form = '<select id="'.$show_target_id.'" name="'.$show_target_name.'" size=1>'.$show_target_form.'</select>';
		
		
		// title
		echo '<table style="width:100%;margin-bottom:15px;"><tbody>
		<tr><th colspan=3 style="text-align:left;">'.__('Main title Setting','DigiPress').' : </th></tr>
		<tr><td style="width:140px;"> - <label for="'.$title_id.'">'.__('Title','DigiPress').'</label> : </td>
		<td><input type="text" name="'.$title_name.'" id="'.$title_id.'" value="'.htmlspecialchars($title).'" style="width:100%;" /></td></tr>
		<tr><td> - <label for="'.$title_size_id.'">'.__('Title Size','DigiPress').'</label> : </td>
		<td><input type="number" min=8 name="'.$title_size_name.'" id="'.$title_size_id.'" value="'.$title_size.'" style="width:50px;" /> px</td></tr>
		<tr><td style="width:140px;"> - <label for="'.$title_color_id.'">'.__('Title Color','DigiPress').'</label> : </td><td><input type="text" name="'.$title_color_name.'" value="'.$title_color.'" class="dp-color-field" data-default-color="'.$def_title_color.'" /></td></tr>
		<tr><td> - <label for="'.$title_enter_pos_id.'">'.__('Moving','DigiPress').'</label> : </td><td>'.$title_enter_pos_form.'</td></tr>
		<tr><td> - <label for="'.$title_scale_id.'">'.__('Scaling','DigiPress').'</label> : </td><td>'.$title_scale_form.'</td></tr>
		<tr><td> - <label for="'.$title_roll_id.'">'.__('Rotation','DigiPress').'</label> : </td><td>'.$title_roll_form.'</td></tr></tbody></table><hr />';

		// Text
		echo '<p style="font-weight:bold;">'.__('Description (HTML)','DigiPress').'</p>';
		wp_editor( htmlspecialchars_decode($text), $text_name, $wp_editor_setings );
		echo '<table style="width:100%;margin-bottom:15px;"><tbody>
		<tr><td> - <label for="'.$text_size_id.'">'.__('Text Size','DigiPress').'</label> : </td>
		<td><input type="number" min=8 name="'.$text_size_name.'" id="'.$text_size_id.'" value="'.$text_size.'" style="width:50px;" /> px</td></tr>
		<tr><td style="width:140px;"> - <label for="'.$text_color_id.'">'.__('Text Color','DigiPress').'</label> : </td><td><input type="text" name="'.$text_color_name.'" value="'.$text_color.'" class="dp-color-field" data-default-color="'.$def_text_color.'" /></td></tr>
		<tr><td> - <label for="'.$text_scale_id.'">'.__('Moving','DigiPress').'</label> : </td><td>'.$text_enter_pos_form.'</td></tr>
		<tr><td> - <label for="'.$text_scale_id.'">'.__('Scaling','DigiPress').'</label> : </td><td>'.$text_scale_form.'</td></tr>
		<tr><td> - <label for="'.$text_roll_id.'">'.__('Rotation','DigiPress').'</label> : </td><td>'.$text_roll_form.'</td></tr></tbody></table><hr />';

		// Button
		echo '<table style="width:100%;margin-bottom:15px;"><tbody>
		 <tr><th colspan=3 style="text-align:left;">'.__('Button Setting','DigiPress').' : </th></tr>
		 <tr><td style="width:120px;">- <label for="'.$btn_text_id.'">'.__('Button Text','DigiPress').'</label> : </td>
		 <td><input type="text" name="'.$btn_text_name.'" id="'.$btn_text_id.'" value="'.htmlspecialchars($btn_text).'" style="width:100%;" /></td></tr>
		 <tr><td> - <label for="'.$btn_url_id.'">'.__('Target URL','DigiPress').'</label> : </td>
		 <td><input type="text" name="'.$btn_url_name.'" id="'.$btn_url_id.'" value="'.$btn_url.'" style="width:100%;" /></td></tr>
		 <tr><td> - <label for="'.$btn_size_id.'">'.__('Button Size','DigiPress').'</label> : </td>
		 <td><input type="number" min=8 name="'.$btn_size_name.'" id="'.$btn_size_id.'" value="'.$btn_size.'" style="width:50px;" /> px</td></tr>
		 <tr><td> - <label for="'.$btn_color_id.'">'.__('Button Color','DigiPress').'</label> : </td><td><input type="text" name="'.$btn_color_name.'" value="'.$btn_color.'" class="dp-color-field" /></td></tr>
		 <tr><td> - <label for="'.$btn_enter_pos_id.'">'.__('Moving','DigiPress').'</label> : </td><td>'.$btn_enter_pos_form.'</td></tr>
		 <tr><td> - <label for="'.$btn_scale_id.'">'.__('Scaling','DigiPress').'</label> : </td><td>'.$btn_scale_form.'</td></tr>
		 <tr><td> - <label for="'.$btn_roll_id.'">'.__('Rotation','DigiPress').'</label> : </td><td>'.$btn_roll_form.'</td></tr></tbody></table><hr />';

		 // image
		echo '<table style="width:100%;margin-bottom:15px;"><tbody>
		<tr><th colspan=3 style="text-align:left;">'.__('Image Setting','DigiPress').' : </th></tr>
		<tr><td style="width:120px;"> - <label for="'.$img_url_id.'">'.__('Image URL','DigiPress').'</label> : </td>
		<td><input type="text" name="'.$img_url_name.'" id="'.$img_url_id.'" value="'.$img_url.'" style="width:100%;" /></td></tr>
		<tr><td> - <label>'.__('Position','DigiPress').'</label> : </td><td>'.$img_pos_form.'</td></tr>
		<tr><td> - <label for="'.$img_enter_pos_id.'">'.__('Moving','DigiPress').'</label> : </td><td>'.$img_enter_pos_form.'</td></tr>
		<tr><td> - <label for="'.$img_scale_id.'">'.__('Scaling','DigiPress').'</label> : </td><td>'.$img_scale_form.'</td></tr>
		<tr><td> - <label for="'.$img_roll_id.'">'.__('Rotation','DigiPress').'</label> : </td><td>'.$img_roll_form.'</td></tr></tbody></table><hr />';
		
		// Background design
		echo '<table style="width:100%;margin-bottom:15px;"><tbody>
		 <tr><th colspan=3 style="text-align:left;">'.__('Background Design','DigiPress').' : </th></tr>';
		// background color
		echo '<tr><td> - <label for="'.$bg_color_id.'">'.__('Bg Color','DigiPress').'</label> : </td>
		<td><input type="text" name="'.$bg_color_name.'" value="'.$bg_color.'" class="dp-color-field" /></td></tr>';
		// Background image
		echo '<tr><td style="width:120px;"> - <label for="'.$bg_img_url_id.'">'.__('Bg Image URL','DigiPress').'</label> : </td><td><input type="text" name="'.$bg_img_url_name.'" id="'.$bg_img_url_id.'" value="'.$bg_img_url.'" style="width:100%;" /></td></tr>';
		// Background video URL
		echo '<tr style="display:none;"><td style="width:120px;vertical-align:top;"> - <label for="'.$bg_video_url_id.'">'.__('Bg Video ID/URL','DigiPress').'</label> : </td><td><input type="text" name="'.$bg_video_url_name.'" id="'.$bg_video_url_id.'" value="'.$bg_video_url.'" style="width:100%;" /><br /><span style="font-size:12px;">'.__('*Note:YouTube or Vimeo only.','DigiPress').'</span></td></tr>';
		// Brightness
		echo '<tr><td style="width:120px;"> - <label for="'.$bg_brightness_id.'">'.__('Bg Brightness','DigiPress').'</label> : </td><td><input type="number" name="'.$bg_brightness_name.'" id="'.$bg_brightness_id.'" min=0 value="'.$bg_brightness.'" style="width:50px;" /> %</td></tr>';

		// Text shadow
		echo '<tr><td> - <label for="'.$text_shadow_id.'">'.__('Text Shadow','DigiPress').'</label> : </td>
		<td><input type="text" name="'.$text_shadow_name.'" value="'.$text_shadow.'" class="dp-color-field" /></td></tr></tbody></table><hr />';

		// Editor
		echo '<div style="margin-bottom:15px;"><p><label for="'.$contents_id.'" style="font-weight:bold;">'.__('Original Parallax Contents','DigiPress').'</label> : </p>';
		wp_editor( htmlspecialchars_decode($contents), $contents_name, $wp_editor_setings );
		echo '</div><hr />';

		// target ID
		echo '<table style="width:100%;"><tbody>
		<tr><th colspan=3 style="text-align:left;">'.__('Display Target','DigiPress').' : </th></tr>
		<tr><td style="width:120px;"> - <label>'.__('Target','DigiPress').'</label> : </td><td>'.$show_target_form.'</td></tr>
		<tr><td style="vertical-align:top;"> - <label for="'.$target_id_id.'">'.__('Post/Page ID','DigiPress').'</label> : </td>
		<td><input type="text" name="'.$target_id_name.'" id="'.$target_id_id.'" value="'.$target_id.'" style="width:100%;" /><br /><span style="font-size:11px;">'.__('Note:Use comma(,) to specify several posts.','DigiPress').'</span></td></tr></tbody></table>';
	}

	function update($new_instance, $old_instance) {
		$instance['title']		= htmlspecialchars_decode(stripslashes($new_instance['title']));
		$instance['title_size'] = mb_convert_kana($new_instance['title_size'],"n");
		if (!is_numeric($instance['title_size'])) {
			$instance['title_size'] = 26;
		}
		$instance['title_color']	= $new_instance['title_color'];
		$instance['title_enter_pos']= $new_instance['title_enter_pos'];
		$instance['title_scale']= $new_instance['title_scale'];
		$instance['title_roll']= $new_instance['title_roll'];

		$instance['text']		= stripslashes($new_instance['text']);
		$instance['text_size'] = mb_convert_kana($new_instance['text_size'],"n");
		if (!is_numeric($instance['text_size'])) {
			$instance['text_size'] = 14;
		}
		$instance['text_color']	= $new_instance['text_color'];
		$instance['text_enter_pos']= $new_instance['text_enter_pos'];
		$instance['text_scale']	= $new_instance['text_scale'];
		$instance['text_roll']	= $new_instance['text_roll'];

		$instance['img_url']	= $new_instance['img_url'];
		$instance['img_pos']	= $new_instance['img_pos'];
		$instance['img_enter_pos']= $new_instance['img_enter_pos'];
		$instance['img_scale']	= $new_instance['img_scale'];
		$instance['img_roll']	= $new_instance['img_roll'];

		$instance['btn_color']	= $new_instance['btn_color'];
		$instance['btn_text']	= htmlspecialchars_decode(stripslashes($new_instance['btn_text']));
		$instance['btn_url']	= $new_instance['btn_url'];
		$instance['btn_size'] 	= mb_convert_kana($new_instance['btn_size'],"n");
		if (!is_numeric($instance['btn_size'])) {
			$instance['btn_size'] = 18;
		}
		$instance['btn_enter_pos']= $new_instance['btn_enter_pos'];
		$instance['btn_scale']	= $new_instance['btn_scale'];
		$instance['btn_roll']	= $new_instance['btn_roll'];

		$instance['bg_color']	= $new_instance['bg_color'];
		$instance['bg_img_url']	= $new_instance['bg_img_url'];
		$instance['bg_video_url']	= $new_instance['bg_video_url'];
		$instance['bg_brightness']	= $new_instance['bg_brightness'];
		$instance['text_shadow']	= $new_instance['text_shadow'];

		$instance['contents']	= stripslashes($new_instance['contents']);

		$instance['show_target']= $new_instance['show_target'];
		$instance['target_id']	= $new_instance['target_id'];
	
		return $instance;
	}

	function widget($args, $instance) {
		// $args = {id, before_widget, after_widget, before_title, after_title}
		// extract($args);
		$instance = wp_parse_args((array)$instance, array('title' 		=> '',
														  'title_color'=> '#444444',
														  'title_size'	=> 26,
														  'title_enter_pos' => 'enter top',
														  'title_scale'	=> 'none',
														  'title_roll'	=> 'none',
														  'text'		=> '',
														  'text_color'	=> '#666666',
														  'text_size'	=> 14,
														  'text_enter_pos' => 'bottom',
														  'text_scale'	=> 'none',
														  'text_roll'	=> 'none',
														  'bg_color'	=> '',
														  'bg_img_url'	=> '',
														  'bg_brightness' => 100,
														  'bg_video_url'=> '',
														  'img_url'		=> '',
														  'img_pos'		=> 'right',
														  'img_enter_pos'=> 'right',
														  'img_scale'	=> 'none',
														  'img_roll'	=> 'none',
														  'text_shadow' => '',
														  'btn_text'	=> '',
														  'btn_size'	=> 18,
														  'btn_color'	=> '',
														  'btn_url'		=> '',
														  'btn_enter_pos'=> '',
														  'btn_scale'	=> '',
														  'btn_roll'	=> '',
														  'contents' 	=> '',
														  'show_target'	=> '',
														  'target_id'	=> ''));

		global $post;

		// Flag
		$flag = false;
		// Target
		$target 	= $instance['show_target'];
		$target_id 	= '';
		if (!empty($instance['target_id'])) {
			$target_id = explode(',', $instance['target_id']);
		}
		// filter
		if ($target === 'post') {
			if (is_single($target_id)){
				$flag = true;
			}
		}
		else if ($target === 'page') {
			if (is_page($target_id)){
				$flag = true;
			}
		}
		else if ($target === 'top page' ) {
			if (is_home() && !is_paged()){
				$flag = true;
			}
		} else {
			$flag = true;
		}

		if ($flag) {
			// scrollReveal js
			// wp_enqueue_script('scrollReveal', DP_THEME_URI . '/inc/js/scrollReveal.min.js', array('jquery'));
			// Show
			$code = dp_parallax_widget_show($instance);
			echo $code;
		}
	}
}
add_action('widgets_init', create_function('', 'return register_widget("DP_PARALLAX_WIDGET");'));


/*******************************************************
* Show parallax contents
*******************************************************/
function dp_parallax_widget_show($instance){
	extract($instance);

	$code 		= '';
	$title_code	= '';
	$title_data_sr = '';
	$desc_code 	= '';
	$desc_data_sr = '';
	$desc_css 	= '';
	$btn_code 	= '';
	$btn_data_sr 	= '';
	$img_code 	= '';
	$img_data_sr 	= '';
	$img_flag	= '';
	$title_css	= '';
	$btn_css 	= '';
	$bg_css 	= '';
	$txt_shadow_css = '';
	$original 	= '';
	$filter_css = '';
	$img_w 		= '';
	$img_h 		= '';
	$img_type 	= '';
	$img_attr 	= '';
	$css 		= '';
	$js_code 	= '';
	$title_wait = '';
	$desc_wait 	= '';
	$btn_wait 	= '';
	$img_wait 	= '';
	$bg_data_attr	= '';
	$plx_bg_code	= '';

	// Unique ID
	$uni_id = 'plx-'.uniqid(mt_rand(100,200));

	// wait time
	if (!empty($$img_url)) {
		switch ($img_pos) {
			case 'left':
			case 'right':
				$title_wait = '';
				$desc_wait 	= ' wait 0.5s';
				$btn_wait 	= '';
				$img_wait 	= ' wait 1.0s';
				break;
			case 'top':
				$title_wait = '';
				$desc_wait 	= ' wait 0.5s';
				$btn_wait 	= ' wait 0.4s';
				$img_wait 	= '';
				break;
			case 'bottom':
				$title_wait = '';
				$desc_wait 	= ' wait 0.5s';
				$btn_wait 	= ' wait 0.4s';
				$img_wait 	= '';
				break;
			default:
				break;
		}
	}

	// title 
	$title_data_sr = ' data-sr="'.$title_enter_pos.' '.$title_scale.' '.$title_roll.$title_wait.'"';
	if (!empty($title)) {
		$title_code = '<h1 class="plx_title"'.$title_data_sr.'>'.$title.'</h1>';
	}
	// title CSS
	if (!empty($title_color)) {
		$title_color = 'color:'.$title_color.';';
	}
	$title_css = '.plx_widget.'.$uni_id.' .plx_title{font-size:'.$title_size.'px;'.$title_color.'}';

	// Description (HTML)
	// Filter hook
	$desc_data_sr = ' data-sr="'.$text_enter_pos.' '.$text_scale.' '.$text_roll.$desc_wait.'"';
	if (!empty( $text )) {
		$text = '<div class="plx_desc"'.$desc_data_sr.'>'.$text.'</div>';
	}
	$desc_code = apply_filters( 'dp_parallax_widget_description', $text, $instance );
	// desc css
	if (!empty($text_color)) {
		$text_color = 'color:'.$text_color.';';
	}
	$desc_css = '.plx_widget.'.$uni_id.' .plx_desc{font-size:'.$text_size.'px;'.$text_color.'}';

	// Button
	$btn_data_sr = ' data-sr="'.$btn_enter_pos.' '.$btn_scale.' '.$btn_roll.$btn_wait.'"';
	if (!empty($btn_text) && !empty($btn_url)) {
		$btn_code = '<div class="plx_btn '.$uni_id.'"'.$btn_data_sr.'><a href="'.$btn_url.'" class="btn">'.$btn_text.'</a></div>';
	}

	// Image
	$img_data_sr = ' data-sr="'.$img_enter_pos.' '.$img_scale.' '.$img_roll.$img_wait.'"';
	if (!empty($img_url)) {
		$img_code = '<img src="'.$img_url.'" class="plx_img '.$img_pos.'"'.$img_data_sr.' alt="'.strip_tags($title).'" />';
		$img_flag = ' use_img';
	}

	// Parallax finish
	if (!empty($title_code) || !empty($desc_code) || !empty($btn_code)) {
		$code = '<div class="plx_wrap '.$img_pos.$img_flag.' clearfix">'.$title_code.$desc_code.$btn_code.'</div>';
	}

	// Combine image tag
	switch ($img_pos) {
		case 'left':
		case 'top':
			$code = $img_code.$code;
			break;
		case 'bottom':
		default:	// right
			$code = $code.$img_code;
			break;
	}

	// Button
	if (DP_BUTTON_STYLE === "flat5"){
		if (!empty($btn_color)) {
			$btn_css = '.plx_btn.'.$uni_id.' a.btn{font-size:'.$btn_size.'px;border-color:'.$btn_color.';}.plx_btn.'.$uni_id.' a.btn:after{background-color:'.$btn_color.';}.plx_btn.'.$uni_id.' a.btn:hover{color:'.$btn_color.'!important;}';
		} else {
			$btn_css = '.plx_btn.'.$uni_id.' a.btn{font-size:'.$btn_size.'px;}';
		}
	} else if (DP_BUTTON_STYLE === "flat6"){
		if (!empty($btn_color)) {
			$btn_css = '.plx_btn.'.$uni_id.' a.btn{font-size:'.$btn_size.'px;border-color:'.$btn_color.';color:'.$btn_color.'!important;}.plx_btn.'.$uni_id.' a.btn:after{background-color:'.$btn_color.';}.plx_btn.'.$uni_id.' a.btn:hover{color:#fff!important;}';
		} else {
			$btn_css = '.plx_btn.'.$uni_id.' a.btn{font-size:'.$btn_size.'px;}';
		}
	} else {
		if (!empty($btn_color)) {
			$btn_css = '.plx_btn.'.$uni_id.' a.btn{font-size:'.$btn_size.'px;background-color:'.$btn_color.';}';
		} else {
			$btn_css = '.plx_btn.'.$uni_id.' a.btn{font-size:'.$btn_size.'px;}';
		}
	}

	// Original Prallax content
	// Filter hook
	if (!empty( $contents )) {
		$contents = '<div class="plx_original clearfix">'.$contents.'</div>';
	}
	$original = apply_filters( 'dp_parallax_widget_content', $contents, $instance );
	
	// CSS
	if (empty($bg_brightness) || $bg_brightness === '100') {
		$filter_css = '';
	} else {
		$filter_css = 'filter:brightness('.$bg_brightness.'%);-webkit-filter:brightness('.$bg_brightness.'%);';
	}
	if (!empty($bg_img_url)){
		list($img_w, $img_h, $img_type, $img_attr) = getimagesize($bg_img_url);
		$bg_data_attr = ' data-img-w="'.$img_w.'" data-img-h="'.$img_h.'"';
		$bg_css = '.plx_widget.'.$uni_id.' .plx_bg{background-image:url('.$bg_img_url.');'.$filter_css.'}';
		$plx_bg_code = '<div class="plx_bg pl_img"'.$bg_data_attr.'></div>';
	} else {
		if (!empty($bg_color)) {
			$bg_color = 'background-color:'.$bg_color.';';
			$bg_css = '.plx_widget.'.$uni_id.' .plx_bg{'.$bg_color.$filter_css.'}';
			$plx_bg_code = '<div class="plx_bg"></div>';
		}
	}
	// Whole Area
	if (!empty($text_shadow)) {
		$rgb = dp_hexToRgb($text_shadow);
		$txt_shadow_css = '.plx_widget.'.$uni_id.'{'.$text_color.'text-shadow:0 1px 3px rgba('.$rgb[0].','.$rgb[1].','.$rgb[2].',0.5);}';
	} else {
		$txt_shadow_css = '.plx_widget.'.$uni_id.'{'.$text_color.'}';
	}
	$css = '<style>'.$txt_shadow_css.$bg_css.'.plx_widget.'.$uni_id.' a,.plx_widget.'.$uni_id.' a:hover,.plx_widget.'.$uni_id.' a:visited{'.$title_color.'}'.$title_css.$desc_css.$btn_css.'</style>';

	// Finish
	$code = '<section class="plx_widget '.$uni_id.'">'.$plx_bg_code.'<div class="widget-box">'.$code.$original.'</div></section>'.$css.$js_code;
	// Display
	return $code;
}

// Enable shortcode
// add_filter('dp_parallax_widget_description', 'do_shortcode');
// add_filter('dp_parallax_widget_content', 'do_shortcode');
?>