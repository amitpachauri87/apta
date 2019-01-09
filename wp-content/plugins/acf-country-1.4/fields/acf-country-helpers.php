<?php

class acf_country_helpers {

	/**
	 * Get field defaults
	 *
	 * @return array
	 */
	public static function get_defaults() {
		return array(
			'multiple'      => 0,
			'allow_null'    => 0,
			'choices'       => array(),
			'default_value' => '',
			'ui'            => 1,
			'return_format' => 'array',
			'placeholder'   => __( 'Select a country', 'acf-country' ),
		);
	}

	/**
	 * Render field
	 *
	 * @param  array $field
	 */
	public static function render_field( $field ) {

		$countries = self::get_countries();

		if ( ! $countries ) {
			printf( 'No country list has been for your locale: %s', esc_html( $locale ) );
			return;
		}

		$field['choices'] = $countries;

		$attrs = array(
			'id'               => $field['id'],
			'class'            => $field['class'],
			'name'             => $field['name'],
			'data-ui'          => $field['ui'],
			'data-multiple'    => $field['multiple'],
			'data-placeholder' => $field['placeholder'],
			'data-allow-null'  => $field['allow_null'] ? 1 : 0,
		);

		$attrs['class'] .= ' acf-country';

		// $field['value']  = array_map( 'strtoupper', acf_get_array($field['value']) );
		$field['value']  = array_map( 'strtoupper', (array) $field['value'] );

		if ( $field['multiple'] ) {
			$attrs['name']    .= '[]';
			$attrs['multiple'] = 'multiple';
			$attrs['size']     = 5;
		}

		$select_attrs = implode(
			' ',
			array_map(
				function( $val, $key ) {
					return sprintf( '%1$s="%2$s"', $key, esc_attr( $val ) );
				},
				$attrs,
				array_keys( $attrs )
			)
		);
		?>
		<?php
		// Empty select multiple will not be posted, thus prevents from saving an empty field/deleting field data
		if ( $field['multiple'] ) :
			?>
			<input type="hidden" name="<?php echo esc_attr( $field['name'] ); ?>" value="" />
		<?php endif; ?>
		<select <?php echo $select_attrs; // phpcs:ignore ?>>
			<?php if ( $field['allow_null'] && ! ( $field['ui'] && $field['multiple'] ) ) : ?>
			<option value="">
				<?php if ( ! $field['ui'] ) : ?>
					- <?php esc_html_e( 'Select a country', 'acf-country' ); ?> -
				<?php endif; ?>
			</option>
			<?php endif; ?>
			<?php if ( is_array( $field['choices'] ) ) : ?>
				<?php foreach ( $field['choices'] as $code => $country ) : ?>
				<option value="<?php echo esc_attr( $code ); ?>" <?php selected( in_array( $code, $field['value'], true ) ); ?>><?php echo esc_html( $country ); ?></option>
				<?php endforeach; ?>
			<?php endif; ?>
		</select>
		<?php
	}

	/**
	 * Get countries
	 *
	 * @param  string $locale
	 * @return boolean|array
	 */
	public static function get_countries( $locale = null ) {

		$locale = $locale ? $locale : get_locale();
		$file   = sprintf( '%s/vendor/umpirsky/country-list/data/%s/country.php', dirname( dirname( __FILE__ ) ), $locale );

		if ( ! is_file( $file ) ) {
			return false;
		}

		return include $file;
	}

	/**
	 * Format value
	 *
	 * @param  string|array $value
	 * @param  array        $field
	 * @return string|array
	 */
	public static function format_country( $value, $field ) {

		$countries = self::get_countries();

		if ( ! $countries ) {
			return $value;
		}

		if ( is_array( $value ) ) {

			// default to array
			// post PHP 5.5
			// $value = array_filter(
			// 	$countries,
			// 	function( $k ) use ( $value ) {
			// 		return in_array( $k, $value, true );
			// 	},
			// 	ARRAY_FILTER_USE_KEY
			// );
			$value_new = array();
			foreach ( $countries as $code => $country ) {
				if ( in_array( $code, $value, true ) ) {
					$value_new[ $code ] = $country;
				}
			}
			$value = $value_new;

			// name
			if ( $field['return_format'] === 'name' ) {
				$value = array_values( $value );
			}

			// code
			if ( $field['return_format'] === 'code' ) {
				$value = array_keys( $value );
			}
		} else {

			$country_name = isset( $countries[ $value ] ) ? $countries[ $value ] : $value;

			// name
			if ( $field['return_format'] === 'name' ) {
				$value = $country_name;
			}

			// array
			if ( $field['return_format'] === 'array' ) {
				$value = array( $value => $country_name );
			}
		}

		// return
		return $value;
	}

}