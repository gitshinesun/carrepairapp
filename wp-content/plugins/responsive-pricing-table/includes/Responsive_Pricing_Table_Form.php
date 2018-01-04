<?php
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! trait_exists( 'Responsive_Pricing_Table_Form' ) ):

	trait Responsive_Pricing_Table_Form {

		public function text( array $args ) {
			if ( ! isset( $args['id'], $args['name'] ) ) {
				return;
			}

			list( $name, $value ) = $this->field_common( $args );

			echo $this->field_before( $args );
			echo sprintf( '<input type="text" class="sp-input-text" value="%1$s" id="%2$s" name="%3$s">', $value,
				$args['id'], $name );
			echo $this->field_after();
		}

		public function textarea( array $args ) {
			if ( ! isset( $args['id'], $args['name'] ) ) {
				return;
			}

			list( $name, $value ) = $this->field_common( $args );
			$cols = isset( $args['cols'] ) ? $args['cols'] : 35;
			$rows = isset( $args['rows'] ) ? $args['rows'] : 6;

			echo $this->field_before( $args );
			echo sprintf( '<textarea class="sp-input-textarea" id="%2$s" name="%3$s" cols="%4$d" rows="%5$d">%1$s</textarea>',
				esc_textarea( $value ), $args['id'], $name, $cols, $rows );
			echo $this->field_after();
		}

		public function editor( array $args ) {
			if ( ! isset( $args['id'], $args['name'] ) ) {
				return;
			}

			list( $name, $value ) = $this->field_common( $args );
			$rows = isset( $args['rows'] ) ? $args['rows'] : 6;
			// $cols = isset( $args['cols'] ) ? $args['cols'] : 35;

			echo $this->field_before( $args );
			ob_start();
			echo "<div class='sp-wp-editor-container'>";
			wp_editor( $value, $args['id'], array(
				'textarea_name' => $name,
				'tinymce'       => false,
				'media_buttons' => false,
				'textarea_rows' => isset( $rows ) ? $rows : 6,
				'quicktags'     => array( "buttons" => "strong,em,link,img" ),
			) );
			echo "</div>";
			echo ob_get_clean();
			echo $this->field_after();
		}

		public function color( array $args ) {
			if ( ! isset( $args['id'], $args['name'] ) ) {
				return;
			}

			list( $name, $value ) = $this->field_common( $args );
			$std_value = isset( $args['std'] ) ? $args['std'] : '';

			echo $this->field_before( $args );
			echo sprintf( '<input type="text" class="colorpicker" value="%1$s" id="%2$s" name="%3$s" data-default-color="%4$s">',
				$value, $args['id'], $name, $std_value );
			echo $this->field_after();
		}

		public function date( array $args ) {
			if ( ! isset( $args['id'], $args['name'] ) ) {
				return;
			}

			list( $name, $value ) = $this->field_common( $args );
			$std_value = isset( $args['std'] ) ? $args['std'] : '';

			echo $this->field_before( $args );
			echo sprintf( '<input type="text" class="sp-input-text datepicker" value="%1$s" id="%2$s" name="%3$s">',
				$value, $args['id'], $name, $std_value );
			echo $this->field_after();
		}

		public function number( array $args ) {
			if ( ! isset( $args['id'], $args['name'] ) ) {
				return;
			}

			list( $name, $value ) = $this->field_common( $args );
			echo $this->field_before( $args );
			echo sprintf( '<input type="number" class="sp-input-text" value="%1$s" id="%2$s" name="%3$s">', $value,
				$args['id'], $name );
			echo $this->field_after();
		}

		public function checkbox( array $args ) {
			if ( ! isset( $args['id'], $args['name'] ) ) {
				return;
			}

			list( $name, $value ) = $this->field_common( $args );
			$checked = ( $value == 'on' ) ? ' checked' : '';
			$label   = isset( $args['label'] ) ? $args['label'] : '';
			$class   = isset( $args['class'] ) ? 'class="' . $args['class'] . '"' : '';

			echo $this->field_before( $args );
			echo '<label><input type="checkbox" ' . $checked . ' ' . $class . ' value="on" name="' . $name . '">' . $label . '</label>';
			echo $this->field_after();
		}

		public function select( $args ) {
			if ( ! isset( $args['id'], $args['name'] ) ) {
				return;
			}

			list( $name, $value ) = $this->field_common( $args );
			$multiple = isset( $args['multiple'] ) ? 'multiple' : '';

			echo $this->field_before( $args );
			echo '<select name="' . $name . '" id="' . $args['id'] . '" class="select2 sp-input-text" ' . $multiple . '>';
			foreach ( $args['options'] as $key => $option ) {
				$selected = ( $value == $key ) ? ' selected="selected"' : '';
				echo '<option value="' . $key . '" ' . $selected . '>' . $option . '</option>';
			}
			echo '</select>';
			echo $this->field_after();
		}

		private function field_common( $args ) {
			global $post;
			// Meta Name
			$group    = isset( $args['group'] ) ? $args['group'] : 'responsive_pricing_table';
			$multiple = isset( $args['multiple'] ) ? '[]' : '';
			$name     = sprintf( '%s[%s]%s', $group, $args['id'], $multiple );

			// Meta Value
			$std_value = isset( $args['std'] ) ? $args['std'] : '';
			$meta      = get_post_meta( $post->ID, $args['id'], true );
			$value     = ! empty( $meta ) ? $meta : $std_value;

			if ( $value == 'zero' ) {
				$value = 0;
			}

			return array( $name, $value );
		}

		private function field_before( $args ) {
			$table = sprintf( '<div class="sp-input-group" id="field-%s">', $args['id'] );
			$table .= sprintf( '<div class="sp-input-label">' );
			$table .= sprintf( '<label for="%1$s">%2$s</label>', $args['id'], $args['name'] );
			if ( ! empty( $args['desc'] ) ) {
				if ( is_array( $args['desc'] ) ) {
					foreach ( $args['desc'] as $desc ) {
						$table .= sprintf( '<p class="sp-input-desc">%s</p>', $desc );
					}
				} else {
					$table .= sprintf( '<p class="sp-input-desc">%s</p>', $args['desc'] );
				}
			}
			$table .= '</div>';
			$table .= sprintf( '<div class="sp-input-field">' );

			return $table;
		}

		private function field_after() {
			return '</div></div>';
		}
	}

endif;