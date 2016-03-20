<?php

/**
 * Radio image customize control.
 *
 */
class four_leaf_clover_Customize_Control_Radio_Image extends WP_Customize_Control {

	/**
	* The type of customize control being rendered.
	*
	*/
	public $type = 'radio-image';

	/**
	* Loads the jQuery UI Button script and custom scripts/styles.
	*
	*/
	public function enqueue() {
		wp_enqueue_script('jquery-ui-button');
		wp_enqueue_script('four_leaf_clover-customize-controls', get_template_directory_uri() . '/javascript/customize-controls.js', array( 'jquery' ),1.0,true );
		wp_enqueue_style('four_leaf_clover-customize-controls', get_template_directory_uri() . '/css/customize-controls.css');
	}

	/**
	* Add custom JSON parameters to use in the JS template.
	*
	*/
	public function to_json() {
		parent::to_json();

		// We need to make sure we have the correct image URL.
		foreach ( $this->choices as $value => $args )
			$this->choices[ $value ]['url'] = esc_url( sprintf( $args['url'], get_template_directory_uri(), get_stylesheet_directory_uri() ) );

		$this->json['choices'] = $this->choices;
		$this->json['link']    = $this->get_link();
		$this->json['value']   = $this->value();
		$this->json['id']      = $this->id;
	}

	/**
	* Underscore JS template to handle the control's output.
	*
	*/
	public function content_template() { ?>

		<# if ( ! data.choices ) {
			return;
		} #>

		<# if ( data.label ) { #>
			<span class="customize-control-title">{{ data.label }}</span>
		<# } #>

		<# if ( data.description ) { #>
			<span class="description customize-control-description">{{{ data.description }}}</span>
		<# } #>
		<div class="buttonset">

			<# for ( key in data.choices ) { #>

				<input type="radio" value="{{ key }}" name="_customize-{{ data.type }}-{{ data.id }}" id="{{ data.id }}-{{ key }}" {{{ data.link }}} <# if ( key === data.value ) { #> checked="checked" <# } #> /> 

				<label for="{{ data.id }}-{{ key }}">
					<span class="screen-reader-text">{{ data.choices[ key ]['label'] }}</span>
					<img src="{{ data.choices[ key ]['url'] }}" alt="{{ data.choices[ key ]['label'] }}" />
				</label>
			<# } #>

		</div><!-- .buttonset -->
	<?php }
}