<?php
/**
 * Elementor Blog Post Filter List.
 *
 * Elementor widget that inserts a checkbox list of categories to use with the blog filter
 *
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


class EC_Cat_List_Widget extends \Elementor\Widget_Base {

	public function __construct( $data = [], $args = null ) {
		parent::__construct( $data, $args );
	
		
	}

	public function get_style_depends() {
		return [ 'cat-list-checkbox' ];
	}
	public function get_script_depends() {
		return [ 'cat-list-checkbox' ];
	}


	/**
	 * Get widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'cat-list-checkbox';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Cat List Checkboxes', 'ec-bf-widget' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return ' eicon-check-circle';
	}

	/**
	 * Get custom help URL where the user can get more information about the widget.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget help URL.
	 */
	public function get_custom_help_url() {
		return 'https://developers.elementor.com/docs/widgets/';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'basic' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'checkbox', 'checkboxes', 'category', 'categories' ];
	}

	/**
	 * Register hero widget controls.
	 *
	 * Add input fields to allow the user to customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'ec-bf-widget' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

    $this->add_control(
			'el_list_title',
			[
				'label' => esc_html__( 'List title', 'ec-bf-widget' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'el_list_tax',
			[
				'label' => esc_html__( 'List Tax', 'ec-bf-widget' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);
    
		$this->add_control(
			'el_all_text',
			[
				'label' => esc_html__( 'All Text', 'ec-bf-widget' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Render widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

    $settings = $this->get_settings_for_display();
    $taxonomy =  $settings['el_list_tax'];

        $cat_args = array(
            'orderby'      => 'name',
            'taxonomy' => $taxonomy,
            'style' => 'none'
        );

        $all_cats = get_categories($cat_args);


?>
<h3 class="block mt-4 font-bold font-black value-heading font-openSans"><?php echo esc_html( $settings['el_list_title'] ); ?></h3>
    <div class="blog-filter" >
    
                <label for="">
                    <input  class="all" value="all" type="checkbox"/>
                    <?php echo esc_html( $settings['el_all_text'] ); ?>
                </label>
                <?php 
                   foreach($all_cats as $cats){?>
                    <label class="bf-label">
                        <input value="<?php echo ($cats->name)?>" type="checkbox" />
                        <?php echo ($cats->name)?>  
                </label>
                    <?php }
                ?>                          
           
    </div>
    
    <?php

	}

}