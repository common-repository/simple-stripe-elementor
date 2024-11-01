<?php
/**
 * Elementor Widget.
 *
 *
 * @since 1.0.0
 */
class Stripe_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve oEmbed widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'stripe';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve oEmbed widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Simple Stripe Elementor', 'extension-stripe-mas' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve oEmbed widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'fab fa-stripe';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the oEmbed widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'general' ];
	}

	/**
	 * Register oEmbed widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {

		$this->start_controls_section(
			'setup_section',
			[
				'label' => __( 'Configuración', 'extension-stripe-mas' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(

			'api_id',
			[
				'label' => __( 'API ID:', 'extension-stripe-mas' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'price_xxxx', 'extension-stripe-mas' ),
				'description' => 'Valor disponible en la configuración del producto',
			]
		);

		
		$this->add_control(

			'public_key',
			[
				'label' => __( 'Clave pública:', 'extension-stripe-mas' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'pk_live_xxxx', 'extension-stripe-mas' ),
				'description' => 'API KEY disponible en el apartado developer, de Stripe.',
			]
		);
		
		$this->add_control(

			'page_tks',
			[
				'label' => __( 'Pago aprobado:', 'extension-stripe-mas' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'site.com/gracias', 'extension-stripe-mas' ),
				'description' => 'URL de su página de gracias.',
			]
		);
		
		$this->add_control(

			'page_rec',
			[
				'label' => __( 'Pago cancelado:', 'extension-stripe-mas' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'site.com/error', 'extension-stripe-mas' ),
				'description' => 'URL de su página de pago no aprobado.',
			]
		);


		$this->end_controls_section();
		
		/*------------------------------------------------------
		* Sección de personalización
		*------------------------------------------------------*/
		$this->start_controls_section(
			'design_section',
			[
				'label' => __( 'Diseño', 'extension-stripe-mas' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		
		$this->add_control(

			'btn_text',
			[
				'label' => __( 'Texto del botón:', 'extension-stripe-mas' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( '¡Comprar ahora!', 'extension-stripe-mas' ),
				'description' => 'Texto para el botón.',
			]
		);
		
		$this->add_control(
			'btn_color',
			[
				'label' => __( 'Color del botón:', 'extension-stripe-mas' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#19DAF9',
			]
		);
		
		$this->add_control(
			'btn_font',
			[
				'label' => __( 'Fuente:', 'extension-stripe-mas' ),
				'type' => \Elementor\Controls_Manager::FONT,
				'default' => "'Open Sans', sans-serif",
			]
		);
		
		$this->add_control(

			'btn_size',
			[
				'label' => __( 'Tamaño de la fuente:', 'extension-stripe-mas' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'placeholder' => __( '0', 'extension-stripe-mas' ),
				'description' => 'Ingrese un valor númerico.',
			]
		);
		
		$this->add_control(

			'btn_radius',
			[
				'label' => __( 'Radio del botón:', 'extension-stripe-mas' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'placeholder' => __( '0', 'extension-stripe-mas' ),
				'description' => '',
			]
		);


		$this->end_controls_section();


}

	/**
	 * Render oEmbed widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {


		$settings = $this->get_settings_for_display();
		
		$api_id = isset($settings['api_id']) ? $settings['api_id'] : '';
		$public_key = isset($settings['public_key']) ? $settings['public_key'] : '';
		$page_tks = isset($settings['page_tks']) ? $settings['page_tks'] : '';
		$page_rec = isset($settings['page_rec']) ? $settings['page_rec'] : '';
		$btn_color = isset($settings['btn_color']) ? $settings['btn_color'] : '';
		$btn_radius = isset($settings['btn_radius']) ? $settings['btn_radius'] : '';
		$btn_font = isset($settings['btn_font']) ? $settings['btn_font'] : '';
		$btn_size = isset($settings['btn_size']) ? $settings['btn_size'] : '';
		$btn_text = isset($settings['btn_text']) ? $settings['btn_text'] : '';


	echo "
	
<!-- Load Stripe.js on your website. -->

<!-- Create a button that your customers click to complete their purchase. Customize the styling to suit your branding. -->

<button
  style='background-color:{$btn_color};color:#FFF;padding:8px 12px;border:0;border-radius:{$btn_radius}px;font-size:{$btn_size}px;font-family:{$btn_font};width:100%;cursor:pointer;' class='checkout-button-{$api_id}' role='link'
>
{$btn_text}
</button>

<div id='error-message'></div>

<script>

jQuery(document).ready(function($) {

    

if(jQuery('#indicator').text() != 'on'){

    /*-- Crea indicador para evitar errores y ser más efuciente ---*/
    var indicator = document.createElement('p'); 
    indicator.setAttribute('id', 'indicator');
    indicator.innerText = 'on';  
    document.body.appendChild(indicator); 
     
    
    console.log('Ready!');
    
    var stripe = Stripe('{$public_key}');
    
    var simpleStripeBtn = $('.checkout-button-{$api_id}');
    
    
    simpleStripeBtn.each(function( index, element ) {
    
        $(element).on('click', function(){
            
            
             // When the customer clicks on the button, redirect
            // them to Checkout.
            stripe.redirectToCheckout({
              lineItems: [{price: '{$api_id}', quantity: 1}],
              mode: 'payment',
              // Do not rely on the redirect to the successUrl for fulfilling
              // purchases, customers may not always reach the success_url after
              // a successful payment.
              // Instead use one of the strategies described in
              // https://stripe.com/docs/payments/checkout/fulfillment
              successUrl: '{$page_tks}',
              cancelUrl: '{$page_rec}',
            })
            .then(function (result) {
              if (result.error) {
                // If `redirectToCheckout` fails due to a browser or network
                // error, display the localized error message to your customer.
                var displayError = document.getElementById('error-message');
                displayError.textContent = result.error.message;
              }
            });
                   
            
        });
  
    });
    
}

});

</script>



		";

	}

}