<?php
/**
 * Codenatives Homepage Setup.
 *
 * One-click admin tool that creates the homepage with all original
 * HTML-site sections stored as Elementor widget content in the database.
 *
 * Access: WordPress Admin → Tools → Setup Homepage
 *
 * @package Codenatives
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Only load in admin context.
if ( ! is_admin() ) {
	return;
}

/**
 * Register admin menu page under Tools.
 */
function cn_setup_homepage_menu() {
	add_management_page(
		esc_html__( 'Codenatives Homepage Setup', 'codenatives' ),
		esc_html__( 'Setup Homepage', 'codenatives' ),
		'manage_options',
		'cn-setup-homepage',
		'cn_setup_homepage_page'
	);
}
add_action( 'admin_menu', 'cn_setup_homepage_menu' );

/**
 * Render the admin page.
 */
function cn_setup_homepage_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( esc_html__( 'Unauthorized access.', 'codenatives' ) );
	}

	// Handle form submission.
	if ( isset( $_POST['cn_setup_homepage_nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['cn_setup_homepage_nonce'] ) ), 'cn_setup_homepage' ) ) {
		$page_id = cn_create_homepage_content();
		if ( $page_id && ! is_wp_error( $page_id ) ) {
			echo '<div class="notice notice-success is-dismissible"><p>';
			printf(
				/* translators: %1$s: view link, %2$s: edit link */
				wp_kses_post( __( 'Homepage created successfully! <a href="%1$s">View Homepage</a> | <a href="%2$s">Edit with Elementor</a>', 'codenatives' ) ),
				esc_url( home_url( '/' ) ),
				esc_url( admin_url( 'post.php?post=' . intval( $page_id ) . '&action=elementor' ) )
			);
			echo '</p></div>';
		} else {
			echo '<div class="notice notice-error"><p>' . esc_html__( 'Failed to create homepage. Please try again.', 'codenatives' ) . '</p></div>';
		}
	}

	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Codenatives Homepage Setup', 'codenatives' ); ?></h1>
		<p><?php esc_html_e( 'This tool creates the homepage with all original design sections stored as Elementor content in the database.', 'codenatives' ); ?></p>
		<p><strong><?php esc_html_e( 'It will:', 'codenatives' ); ?></strong></p>
		<ul style="list-style: disc; padding-left: 20px;">
			<li><?php esc_html_e( 'Create (or update) a "Home" page', 'codenatives' ); ?></li>
			<li><?php esc_html_e( 'Insert all homepage sections (Hero, Solutions, Industries, Platform, CTA) as Elementor content', 'codenatives' ); ?></li>
			<li><?php esc_html_e( 'Set this page as the static front page', 'codenatives' ); ?></li>
			<li><?php esc_html_e( 'Apply the Elementor Header & Footer page template', 'codenatives' ); ?></li>
		</ul>
		<form method="post">
			<?php wp_nonce_field( 'cn_setup_homepage', 'cn_setup_homepage_nonce' ); ?>
			<p>
				<input type="submit" class="button button-primary button-hero" value="<?php esc_attr_e( 'Create Homepage Now', 'codenatives' ); ?>">
			</p>
		</form>
	</div>
	<?php
}

/**
 * Generate a short unique element ID for Elementor.
 *
 * @return string 7-character hex ID.
 */
function cn_eid() {
	return substr( md5( uniqid( wp_rand(), true ) ), 0, 7 );
}

/**
 * Create the homepage with Elementor content.
 *
 * @return int|false Page ID on success, false on failure.
 */
function cn_create_homepage_content() {
	$img  = get_template_directory_uri() . '/assets/images';
	$home = home_url( '/' );

	// Find existing Home page or create new one.
	$page = get_page_by_path( 'home' );

	$page_args = array(
		'post_title'   => 'Home',
		'post_name'    => 'home',
		'post_status'  => 'publish',
		'post_type'    => 'page',
		'post_content' => '',
	);

	if ( $page ) {
		$page_args['ID'] = $page->ID;
		$page_id = wp_update_post( $page_args );
	} else {
		$page_id = wp_insert_post( $page_args );
	}

	if ( is_wp_error( $page_id ) || ! $page_id ) {
		return false;
	}

	// Build Elementor data array.
	$elementor_data = cn_build_elementor_sections( $img, $home );

	// Save Elementor meta.
	update_post_meta( $page_id, '_elementor_data', wp_slash( wp_json_encode( $elementor_data ) ) );
	update_post_meta( $page_id, '_elementor_edit_mode', 'builder' );
	update_post_meta( $page_id, '_elementor_template_type', 'wp-page' );
	update_post_meta( $page_id, '_elementor_version', '3.24.0' );
	update_post_meta( $page_id, '_wp_page_template', 'elementor_header_footer' );

	// Clear Elementor CSS cache for this page.
	delete_post_meta( $page_id, '_elementor_css' );

	// Set as static front page.
	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $page_id );

	// Flush Elementor cache if available.
	if ( class_exists( '\Elementor\Plugin' ) ) {
		\Elementor\Plugin::$instance->files_manager->clear_cache();
	}

	return $page_id;
}

/**
 * Build the full Elementor sections array.
 *
 * Each homepage section is a full-width Elementor section
 * containing one HTML widget with the original site markup.
 *
 * @param string $img  Theme images base URL.
 * @param string $home Site home URL.
 * @return array Elementor sections.
 */
function cn_build_elementor_sections( $img, $home ) {
	$sections = array();

	/**
	 * Helper — wrap HTML string in a full-width Elementor section.
	 */
	$wrap = function ( $html ) {
		return array(
			'id'       => cn_eid(),
			'elType'   => 'section',
			'settings' => array(
				'stretch_section' => 'section-stretched',
				'layout'          => 'full_width',
				'gap'             => 'no',
				'padding'         => array(
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'unit'     => 'px',
					'isLinked' => true,
				),
				'margin'          => array(
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'unit'     => 'px',
					'isLinked' => true,
				),
			),
			'elements' => array(
				array(
					'id'       => cn_eid(),
					'elType'   => 'column',
					'settings' => array(
						'_column_size' => 100,
						'padding'      => array(
							'top'      => '0',
							'right'    => '0',
							'bottom'   => '0',
							'left'     => '0',
							'unit'     => 'px',
							'isLinked' => true,
						),
					),
					'elements' => array(
						array(
							'id'         => cn_eid(),
							'elType'     => 'widget',
							'widgetType' => 'html',
							'settings'   => array(
								'html' => $html,
							),
						),
					),
				),
			),
		);
	};

	// 1. Hero.
	$sections[] = $wrap( cn_section_hero( $img, $home ) );

	// 2. What We Architect.
	$sections[] = $wrap( cn_section_architect() );

	// 3. Solutions Explorer.
	$sections[] = $wrap( cn_section_solutions( $img, $home ) );

	// 4. Parallax Stats.
	$sections[] = $wrap( cn_section_parallax( $img ) );

	// 5. Industries.
	$sections[] = $wrap( cn_section_industries( $home ) );

	// 6. CogentAI Platform.
	$sections[] = $wrap( cn_section_platform( $img, $home ) );

	// 7. CTA.
	$sections[] = $wrap( cn_section_cta( $img, $home ) );

	return $sections;
}

/* ============================================================
   Section HTML Builders
   ============================================================ */

/**
 * Hero section HTML.
 */
function cn_section_hero( $img, $home ) {
	return <<<HTML
<section class="hero">
	<img src="{$img}/hero-bg.jpg" alt="Abstract digital swirl" class="hero-video" style="object-fit: cover;">
	<div class="hero-video-overlay" style="background: rgba(10, 14, 26, 0.35);"></div>
	<div class="cn-container cn-w-full cn-text-left" style="position: relative; z-index: 2;">
		<div class="hero-content" style="max-width: 640px;">
			<div class="hero-badge">
				<span>&#10024;</span> AI-First Enterprise Partner
			</div>
			<h1>AI-First Digital<br>Transformation for<br><span class="text-gradient">Modern Enterprise</span></h1>
			<p class="subtitle" style="max-width: 540px;">We fuse 20+ years of enterprise delivery expertise with cutting-edge artificial intelligence to architect solutions that think, adapt, and scale — turning complexity into competitive advantage.</p>
			<div class="cn-flex cn-flex-wrap cn-gap-4">
				<a href="{$home}contact/" class="btn-main">Start Your AI Journey <span>&rarr;</span></a>
				<a href="{$home}insights/" class="btn-outline-white">View Our Work</a>
			</div>
		</div>
	</div>
</section>
HTML;
}

/**
 * What We Architect section HTML.
 */
function cn_section_architect() {
	return <<<'HTML'
<section class="cn-section animate-on-scroll" style="background: var(--bg-primary);">
	<div class="cn-container">
		<div class="wwd-split">
			<div class="wwd-heading">
				<span class="section-label">What We Architect</span>
				<h2 class="wwd-title">DEFINE STRATEGY.<br>INTEGRATE SYSTEMS.<br><span class="text-gradient">REDESIGN WORKFLOWS.</span><br>SCALE GLOBALLY.</h2>
			</div>
			<div class="wwd-grid">
				<div class="wwd-item">
					<div class="wwd-icon">
						<svg viewBox="0 0 24 24"><path d="M9 3H5a2 2 0 00-2 2v4m6-6h10a2 2 0 012 2v4M9 3v18m0 0h10a2 2 0 002-2V9M9 21H5a2 2 0 01-2-2V9m0 0h18"/></svg>
					</div>
					<h3>Strategy Definition</h3>
					<p>Enterprise roadmaps grounded in operational reality, aligned to measurable outcomes.</p>
				</div>
				<div class="wwd-item">
					<div class="wwd-icon">
						<svg viewBox="0 0 24 24"><path d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
					</div>
					<h3>Systems Integration</h3>
					<p>Connecting legacy, cloud, and third-party platforms into unified orchestration layers.</p>
				</div>
				<div class="wwd-item">
					<div class="wwd-icon">
						<svg viewBox="0 0 24 24"><path d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
					</div>
					<h3>Workflow Redesign</h3>
					<p>Replacing manual bottlenecks with intelligent automation sequences that compound efficiency.</p>
				</div>
				<div class="wwd-item">
					<div class="wwd-icon">
						<svg viewBox="0 0 24 24"><path d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
					</div>
					<h3>Global Deployment</h3>
					<p>Multi-region rollouts with governance, compliance, and localized change enablement built in.</p>
				</div>
				<div class="wwd-item">
					<div class="wwd-icon">
						<svg viewBox="0 0 24 24"><path d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
					</div>
					<h3>Intelligent Digital Coworkers</h3>
					<p>Autonomous agents embedded across procurement, finance, operations, and customer experience.</p>
				</div>
				<div class="wwd-item">
					<div class="wwd-icon">
						<svg viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
					</div>
					<h3>Security-First Architecture</h3>
					<p>Zero-trust foundations with continuous compliance monitoring across every deployment surface.</p>
				</div>
			</div>
		</div>
	</div>
</section>
HTML;
}

/**
 * Solutions Explorer section HTML.
 */
function cn_section_solutions( $img, $home ) {
	return <<<HTML
<section class="cn-section" style="background: var(--bg-secondary);">
	<div class="cn-container">
		<div class="cn-text-center cn-mb-16 animate-on-scroll">
			<span class="section-label">Our Solutions</span>
			<h2 class="cn-text-3xl cn-lg-text-4xl cn-font-black cn-mt-3 cn-mb-4" style="color: var(--text-primary); letter-spacing: -0.02em;">Enterprise Solution Lines</h2>
			<p class="cn-text-lg cn-max-w-2xl cn-mx-auto" style="color: var(--text-secondary); font-weight: 300;">Select a solution to discover how we transform enterprises with AI-first engineering.</p>
		</div>

		<div class="services-explorer animate-on-scroll">
			<!-- Left Column: Solution Navigation -->
			<div class="services-nav-col">
				<div class="service-nav-item active" data-service="0">
					<div class="service-nav-icon"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 010 2.83 2 2 0 01-2.83 0l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-4 0v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83-2.83l.06-.06A1.65 1.65 0 004.68 15a1.65 1.65 0 00-1.51-1H3a2 2 0 010-4h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 012.83-2.83l.06.06A1.65 1.65 0 009 4.68a1.65 1.65 0 001-1.51V3a2 2 0 014 0v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 2.83l-.06.06A1.65 1.65 0 0019.4 9a1.65 1.65 0 001.51 1H21a2 2 0 010 4h-.09a1.65 1.65 0 00-1.51 1z"/></svg></div>
					<div class="service-nav-text">
						<h3 class="service-nav-title">AI Systems</h3>
						<p class="service-nav-subtitle">Autonomous agents &amp; enterprise intelligence</p>
					</div>
				</div>
				<div class="service-nav-item" data-service="1">
					<div class="service-nav-icon"><svg viewBox="0 0 24 24"><path d="M18 10h-1.26A8 8 0 109 20h9a5 5 0 000-10z"/></svg></div>
					<div class="service-nav-text">
						<h3 class="service-nav-title">Cloud Platforms</h3>
						<p class="service-nav-subtitle">Multi-cloud architecture &amp; platform engineering</p>
					</div>
				</div>
				<div class="service-nav-item" data-service="2">
					<div class="service-nav-icon"><svg viewBox="0 0 24 24"><path d="M18 20V10M12 20V4M6 20v-6"/></svg></div>
					<div class="service-nav-text">
						<h3 class="service-nav-title">Data Platforms</h3>
						<p class="service-nav-subtitle">Lakehouse architectures &amp; real-time pipelines</p>
					</div>
				</div>
				<div class="service-nav-item" data-service="3">
					<div class="service-nav-icon"><svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="M9 12l2 2 4-4"/></svg></div>
					<div class="service-nav-text">
						<h3 class="service-nav-title">Cyber Security</h3>
						<p class="service-nav-subtitle">Zero-trust frameworks &amp; threat intelligence</p>
					</div>
				</div>
				<div class="service-nav-item" data-service="4">
					<div class="service-nav-icon"><svg viewBox="0 0 24 24"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg></div>
					<div class="service-nav-text">
						<h3 class="service-nav-title">Digital Engineering</h3>
						<p class="service-nav-subtitle">API-first architecture &amp; app modernization</p>
					</div>
				</div>
				<div class="service-nav-item" data-service="5">
					<div class="service-nav-icon"><svg viewBox="0 0 24 24"><polyline points="23 4 23 10 17 10"/><polyline points="1 20 1 14 7 14"/><path d="M3.51 9a9 9 0 0114.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0020.49 15"/></svg></div>
					<div class="service-nav-text">
						<h3 class="service-nav-title">Managed AI</h3>
						<p class="service-nav-subtitle">AIOps &amp; continuous optimization</p>
					</div>
				</div>
			</div>

			<!-- Right Column: Card Grid -->
			<div class="services-cards-col">
				<div class="service-explore-card highlighted" data-service="0">
					<img src="{$img}/unsplash/photo-1677442136019-21780ecad995.jpg" alt="AI systems and enterprise intelligence" class="card-bg">
					<div class="card-overlay"></div>
					<div class="card-content">
						<h4>AI Systems</h4>
						<div class="card-details">
							<p>Autonomous agent architectures, enterprise copilot systems, and knowledge intelligence platforms that execute decisions at machine speed.</p>
							<a href="{$home}solutions/ai-platforms/" class="read-more">Learn more <span>&rarr;</span></a>
						</div>
					</div>
				</div>
				<div class="service-explore-card" data-service="1">
					<img src="{$img}/unsplash/photo-1451187580459-43490279c0fa.jpg" alt="Cloud infrastructure and global network" class="card-bg">
					<div class="card-overlay"></div>
					<div class="card-content">
						<h4>Cloud Platforms</h4>
						<div class="card-details">
							<p>Multi-cloud fabric architectures with Kubernetes control planes, platform engineering, and edge deployment systems for global operations.</p>
							<a href="{$home}solutions/cloud-platforms/" class="read-more">Learn more <span>&rarr;</span></a>
						</div>
					</div>
				</div>
				<div class="service-explore-card" data-service="2">
					<img src="{$img}/unsplash/photo-1551288049-bebda4e38f71.jpg" alt="Data analytics dashboard visualization" class="card-bg">
					<div class="card-overlay"></div>
					<div class="card-content">
						<h4>Data Platforms</h4>
						<div class="card-details">
							<p>Modern data stacks, lakehouse architectures, and real-time pipelines that convert raw signals into predictive intelligence.</p>
							<a href="{$home}solutions/data-platforms/" class="read-more">Learn more <span>&rarr;</span></a>
						</div>
					</div>
				</div>
				<div class="service-explore-card" data-service="3">
					<img src="{$img}/unsplash/photo-1518770660439-4636190af475.jpg" alt="Cybersecurity circuit board technology" class="card-bg">
					<div class="card-overlay"></div>
					<div class="card-content">
						<h4>Cyber Security</h4>
						<div class="card-details">
							<p>Zero-trust frameworks, cloud security posture management, and threat intelligence operations for continuous enterprise protection.</p>
							<a href="{$home}solutions/cyber-security/" class="read-more">Learn more <span>&rarr;</span></a>
						</div>
					</div>
				</div>
				<div class="service-explore-card" data-service="4">
					<img src="{$img}/unsplash/photo-1461749280684-dccba630e2f6.jpg" alt="Software code on developer screen" class="card-bg">
					<div class="card-overlay"></div>
					<div class="card-content">
						<h4>Digital Engineering</h4>
						<div class="card-details">
							<p>API-first architectures, SaaS product engineering, and intelligent workflow automation that modernize enterprise application estates.</p>
							<a href="{$home}solutions/digital-engineering/" class="read-more">Learn more <span>&rarr;</span></a>
						</div>
					</div>
				</div>
				<div class="service-explore-card" data-service="5">
					<img src="{$img}/unsplash/photo-1558494949-ef010cbdcc31.jpg" alt="Data center server room operations" class="card-bg">
					<div class="card-overlay"></div>
					<div class="card-content">
						<h4>Managed AI</h4>
						<div class="card-details">
							<p>AIOps, model monitoring, performance optimization, and security operations that keep intelligent systems running reliably at scale.</p>
							<a href="{$home}solutions/managed-ai/" class="read-more">Learn more <span>&rarr;</span></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
HTML;
}

/**
 * Parallax stats section HTML.
 */
function cn_section_parallax( $img ) {
	return <<<HTML
<section class="parallax-section">
	<img src="{$img}/unsplash/photo-1504384308090-c894fdcc538d.jpg" alt="Enterprise technology operations" class="parallax-bg">
	<div class="parallax-overlay"></div>
	<div class="parallax-content cn-container cn-w-full">
		<div style="max-width: 42rem;">
			<span class="section-label" style="color: #60a5fa;">Our Approach</span>
			<h2 class="cn-text-3xl cn-lg-text-4xl cn-font-black cn-mt-3 cn-mb-6" style="color: #fff; line-height: 1.15;">We Don't Just Advise.<br>We <span class="text-gradient">Architect and Deliver</span>.</h2>
			<p style="color: #94a3b8; font-size: 1.05rem; line-height: 1.8; font-weight: 300; margin-bottom: 28px;">
				Most consultancies hand over a strategy deck and leave. We stay through integration, testing, deployment, and optimization. Every engagement produces operational systems, not slide decks.
			</p>
			<div class="cn-grid cn-grid-cols-2 cn-sm-grid-cols-4 cn-gap-6 cn-mt-8">
				<div class="cn-text-center">
					<div class="stat-number text-gradient" data-count="150" data-suffix="+">0+</div>
					<div style="font-size: 0.8rem; color: #94a3b8;">Enterprise Engagements</div>
				</div>
				<div class="cn-text-center">
					<div class="stat-number text-gradient" data-count="40" data-suffix="+">0+</div>
					<div style="font-size: 0.8rem; color: #94a3b8;">Fortune 500 Clients</div>
				</div>
				<div class="cn-text-center">
					<div class="stat-number text-gradient" data-count="7" data-suffix="">0</div>
					<div style="font-size: 0.8rem; color: #94a3b8;">Countries Deployed</div>
				</div>
				<div class="cn-text-center">
					<div class="stat-number text-gradient" data-count="98" data-suffix="%">0%</div>
					<div style="font-size: 0.8rem; color: #94a3b8;">Client Retention</div>
				</div>
			</div>
		</div>
	</div>
</section>
HTML;
}

/**
 * Industries section HTML.
 */
function cn_section_industries( $home ) {
	return <<<HTML
<section class="cn-section animate-on-scroll" style="background: var(--bg-primary);">
	<div class="cn-container">
		<div class="cn-text-center cn-mb-16">
			<span class="section-label">Industries</span>
			<h2 class="section-title cn-mt-3">Sector-Specific Transformation at Enterprise Scale</h2>
			<p class="section-subtitle">Deep domain expertise across regulated, high-complexity industries where generic solutions fail.</p>
		</div>

		<div class="cn-grid cn-sm-grid-cols-2 cn-lg-grid-cols-3 cn-gap-8">
			<a href="{$home}industries/healthcare/" class="industry-card">
				<div class="industry-card-icon"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg></div>
				<h3>Healthcare</h3>
				<p>Clinical workflow intelligence, regulatory compliance automation, and patient experience platforms.</p>
				<span class="read-more" style="color: var(--accent-blue); font-size: 0.85rem; font-weight: 600;">Explore &#8594;</span>
			</a>
			<a href="{$home}industries/manufacturing/" class="industry-card">
				<div class="industry-card-icon"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 010 2.83 2 2 0 01-2.83 0l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-4 0v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83-2.83l.06-.06A1.65 1.65 0 004.68 15a1.65 1.65 0 00-1.51-1H3a2 2 0 010-4h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 012.83-2.83l.06.06A1.65 1.65 0 009 4.68a1.65 1.65 0 001-1.51V3a2 2 0 014 0v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 2.83l-.06.06A1.65 1.65 0 0019.4 9a1.65 1.65 0 001.51 1H21a2 2 0 010 4h-.09a1.65 1.65 0 00-1.51 1z"/></svg></div>
				<h3>Manufacturing</h3>
				<p>Predictive maintenance systems, production optimization, and smart factory orchestration.</p>
				<span class="read-more" style="color: var(--accent-blue); font-size: 0.85rem; font-weight: 600;">Explore &#8594;</span>
			</a>
			<a href="{$home}industries/supply-chain/" class="industry-card">
				<div class="industry-card-icon"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg></div>
				<h3>Supply Chain</h3>
				<p>End-to-end visibility platforms, demand forecasting engines, and autonomous logistics systems.</p>
				<span class="read-more" style="color: var(--accent-blue); font-size: 0.85rem; font-weight: 600;">Explore &#8594;</span>
			</a>
			<a href="{$home}industries/financial-services/" class="industry-card">
				<div class="industry-card-icon"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg></div>
				<h3>Financial Services</h3>
				<p>Risk modeling platforms, regulatory reporting automation, and fraud detection architectures.</p>
				<span class="read-more" style="color: var(--accent-blue); font-size: 0.85rem; font-weight: 600;">Explore &#8594;</span>
			</a>
			<a href="{$home}industries/human-resources/" class="industry-card">
				<div class="industry-card-icon"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg></div>
				<h3>Human Resources</h3>
				<p>Talent intelligence platforms, workforce planning automation, and employee experience systems.</p>
				<span class="read-more" style="color: var(--accent-blue); font-size: 0.85rem; font-weight: 600;">Explore &#8594;</span>
			</a>
			<a href="{$home}solutions/innovation-lab/" class="industry-card" style="background: #0a0e1a; border-color: rgba(255,255,255,0.08); color: #fff;">
				<div class="industry-card-icon" style="color: #facc15;"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18h6"/><path d="M10 22h4"/><path d="M15.09 14c.18-.98.65-1.74 1.41-2.5A4.65 4.65 0 0018 8 6 6 0 006 8c0 1 .23 2.23 1.5 3.5C8.26 12.26 8.73 13.02 8.91 14"/><line x1="9" y1="18" x2="9" y2="14"/><line x1="15" y1="18" x2="15" y2="14"/></svg></div>
				<h3 style="color: #fff;">Innovation Lab</h3>
				<p style="color: #94a3b8;">Where emerging technologies become enterprise-grade capabilities. Proof of concept to production.</p>
				<span class="read-more" style="color: var(--accent-green); font-size: 0.85rem; font-weight: 600;">Explore Lab &#8594;</span>
			</a>
		</div>
	</div>
</section>
HTML;
}

/**
 * CogentAI Platform section HTML.
 */
function cn_section_platform( $img, $home ) {
	return <<<HTML
<section class="cn-section animate-on-scroll" style="background: var(--bg-secondary);">
	<div class="cn-container">
		<div class="cn-grid cn-lg-grid-cols-5 cn-gap-12 cn-items-center">
			<div class="cn-lg-col-span-4">
				<span class="section-label">Our Platform</span>
				<h2 class="section-title cn-mt-3">Enterprise AI Agents That Operate Within Your Infrastructure</h2>
				<p style="font-size: 1.05rem; color: var(--text-secondary); line-height: 1.8; font-weight: 300; margin-top: 16px;">
					CogentAI is our language-model-agnostic agents platform built for complex business process automation. It embeds intelligent agents directly into your existing enterprise workflows &mdash; SAP, Salesforce, Microsoft 365, Oracle, and more &mdash; while keeping all data exactly where it resides. No migration. No vendor lock-in. Complete operational sovereignty.
				</p>
				<div class="cn-mt-6">
					<a href="{$home}platform/" class="btn-main">Explore the Platform <span>&#8594;</span></a>
				</div>
			</div>
			<div class="cn-lg-col-span-1 cn-flex cn-justify-center cn-lg-justify-end">
				<img src="{$img}/platform/cogentai-logo-dark.svg" alt="CogentAI" class="nav-logo-light" style="max-width: 160px; width: 100%;">
				<img src="{$img}/platform/cogentai-logo-light.svg" alt="CogentAI" class="nav-logo-dark" style="max-width: 160px; width: 100%;">
			</div>
		</div>
	</div>
</section>
HTML;
}

/**
 * CTA section HTML.
 */
function cn_section_cta( $img, $home ) {
	return <<<HTML
<section class="cn-section-sm" style="background: var(--bg-primary);">
	<div class="cn-container">
		<div class="cta-connect-box">
			<div class="cta-connect-text">
				<h2><span class="cta-connect-bold">Navigate</span> the next steps<br>ahead with us! <span class="cta-arrow">&#8599;</span></h2>
				<p class="cta-connect-subtitle">Ready to ignite your progress?</p>
				<div class="cta-connect-actions">
					<a href="{$home}contact/" class="cta-talk-btn">LET'S TALK!</a>
				</div>
			</div>
			<div class="cta-connect-image">
				<img src="{$img}/content/stand-out-2048x1529.png" alt="Stand out with Codenatives">
			</div>
		</div>
	</div>
</section>
HTML;
}
