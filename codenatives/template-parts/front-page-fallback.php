<?php
/**
 * Front Page Fallback Template.
 *
 * Renders the static HTML homepage content from the original site.
 * This is shown until Elementor (or the WordPress editor) provides page content.
 *
 * @package Codenatives
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$img = esc_url( get_template_directory_uri() . '/assets/images' );
?>

<!-- ===== HERO ===== -->
<section class="hero">
	<img src="<?php echo $img; ?>/hero-bg.jpg" alt="<?php esc_attr_e( 'Abstract digital swirl', 'codenatives' ); ?>" class="hero-video" style="object-fit: cover;">
	<div class="hero-video-overlay" style="background: rgba(10, 14, 26, 0.35);"></div>
	<div class="cn-container cn-w-full cn-text-left" style="position: relative; z-index: 2;">
		<div class="hero-content" style="max-width: 640px;">
			<div class="hero-badge">
				<span>&#10024;</span> <?php esc_html_e( 'AI-First Enterprise Partner', 'codenatives' ); ?>
			</div>
			<h1><?php echo wp_kses_post( __( 'AI-First Digital<br>Transformation for<br><span class="text-gradient">Modern Enterprise</span>', 'codenatives' ) ); ?></h1>
			<p class="subtitle" style="max-width: 540px;"><?php esc_html_e( 'We fuse 20+ years of enterprise delivery expertise with cutting-edge artificial intelligence to architect solutions that think, adapt, and scale — turning complexity into competitive advantage.', 'codenatives' ); ?></p>
			<div class="cn-flex cn-flex-wrap cn-gap-4">
				<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn-main"><?php esc_html_e( 'Start Your AI Journey', 'codenatives' ); ?> <span>&rarr;</span></a>
				<a href="<?php echo esc_url( home_url( '/insights/' ) ); ?>" class="btn-outline-white"><?php esc_html_e( 'View Our Work', 'codenatives' ); ?></a>
			</div>
		</div>
	</div>
</section>

<!-- Section: What We Architect -->
<section class="cn-section animate-on-scroll" style="background: var(--bg-primary);">
	<div class="cn-container">
		<div class="wwd-split">
			<div class="wwd-heading">
				<span class="section-label"><?php esc_html_e( 'What We Architect', 'codenatives' ); ?></span>
				<h2 class="wwd-title"><?php echo wp_kses_post( __( 'DEFINE STRATEGY.<br>INTEGRATE SYSTEMS.<br><span class="text-gradient">REDESIGN WORKFLOWS.</span><br>SCALE GLOBALLY.', 'codenatives' ) ); ?></h2>
			</div>
			<div class="wwd-grid">
				<div class="wwd-item">
					<div class="wwd-icon">
						<svg viewBox="0 0 24 24"><path d="M9 3H5a2 2 0 00-2 2v4m6-6h10a2 2 0 012 2v4M9 3v18m0 0h10a2 2 0 002-2V9M9 21H5a2 2 0 01-2-2V9m0 0h18"/></svg>
					</div>
					<h3><?php esc_html_e( 'Strategy Definition', 'codenatives' ); ?></h3>
					<p><?php esc_html_e( 'Enterprise roadmaps grounded in operational reality, aligned to measurable outcomes.', 'codenatives' ); ?></p>
				</div>
				<div class="wwd-item">
					<div class="wwd-icon">
						<svg viewBox="0 0 24 24"><path d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
					</div>
					<h3><?php esc_html_e( 'Systems Integration', 'codenatives' ); ?></h3>
					<p><?php esc_html_e( 'Connecting legacy, cloud, and third-party platforms into unified orchestration layers.', 'codenatives' ); ?></p>
				</div>
				<div class="wwd-item">
					<div class="wwd-icon">
						<svg viewBox="0 0 24 24"><path d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
					</div>
					<h3><?php esc_html_e( 'Workflow Redesign', 'codenatives' ); ?></h3>
					<p><?php esc_html_e( 'Replacing manual bottlenecks with intelligent automation sequences that compound efficiency.', 'codenatives' ); ?></p>
				</div>
				<div class="wwd-item">
					<div class="wwd-icon">
						<svg viewBox="0 0 24 24"><path d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
					</div>
					<h3><?php esc_html_e( 'Global Deployment', 'codenatives' ); ?></h3>
					<p><?php esc_html_e( 'Multi-region rollouts with governance, compliance, and localized change enablement built in.', 'codenatives' ); ?></p>
				</div>
				<div class="wwd-item">
					<div class="wwd-icon">
						<svg viewBox="0 0 24 24"><path d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
					</div>
					<h3><?php esc_html_e( 'Intelligent Digital Coworkers', 'codenatives' ); ?></h3>
					<p><?php esc_html_e( 'Autonomous agents embedded across procurement, finance, operations, and customer experience.', 'codenatives' ); ?></p>
				</div>
				<div class="wwd-item">
					<div class="wwd-icon">
						<svg viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
					</div>
					<h3><?php esc_html_e( 'Security-First Architecture', 'codenatives' ); ?></h3>
					<p><?php esc_html_e( 'Zero-trust foundations with continuous compliance monitoring across every deployment surface.', 'codenatives' ); ?></p>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- ===== INTERACTIVE SOLUTIONS EXPLORER ===== -->
<section class="cn-section" style="background: var(--bg-secondary);">
	<div class="cn-container">
		<div class="cn-text-center cn-mb-16 animate-on-scroll">
			<span class="section-label"><?php esc_html_e( 'Our Solutions', 'codenatives' ); ?></span>
			<h2 class="cn-text-3xl cn-lg-text-4xl cn-font-black cn-mt-3 cn-mb-4" style="color: var(--text-primary); letter-spacing: -0.02em;"><?php esc_html_e( 'Enterprise Solution Lines', 'codenatives' ); ?></h2>
			<p class="cn-text-lg cn-max-w-2xl cn-mx-auto" style="color: var(--text-secondary); font-weight: 300;"><?php esc_html_e( 'Select a solution to discover how we transform enterprises with AI-first engineering.', 'codenatives' ); ?></p>
		</div>

		<div class="services-explorer animate-on-scroll">
			<!-- Left Column: Solution Navigation -->
			<div class="services-nav-col">
				<div class="service-nav-item active" data-service="0">
					<div class="service-nav-icon"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 010 2.83 2 2 0 01-2.83 0l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-4 0v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83-2.83l.06-.06A1.65 1.65 0 004.68 15a1.65 1.65 0 00-1.51-1H3a2 2 0 010-4h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 012.83-2.83l.06.06A1.65 1.65 0 009 4.68a1.65 1.65 0 001-1.51V3a2 2 0 014 0v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 2.83l-.06.06A1.65 1.65 0 0019.4 9a1.65 1.65 0 001.51 1H21a2 2 0 010 4h-.09a1.65 1.65 0 00-1.51 1z"/></svg></div>
					<div class="service-nav-text">
						<h3 class="service-nav-title"><?php esc_html_e( 'AI Systems', 'codenatives' ); ?></h3>
						<p class="service-nav-subtitle"><?php esc_html_e( 'Autonomous agents & enterprise intelligence', 'codenatives' ); ?></p>
					</div>
				</div>
				<div class="service-nav-item" data-service="1">
					<div class="service-nav-icon"><svg viewBox="0 0 24 24"><path d="M18 10h-1.26A8 8 0 109 20h9a5 5 0 000-10z"/></svg></div>
					<div class="service-nav-text">
						<h3 class="service-nav-title"><?php esc_html_e( 'Cloud Platforms', 'codenatives' ); ?></h3>
						<p class="service-nav-subtitle"><?php esc_html_e( 'Multi-cloud architecture & platform engineering', 'codenatives' ); ?></p>
					</div>
				</div>
				<div class="service-nav-item" data-service="2">
					<div class="service-nav-icon"><svg viewBox="0 0 24 24"><path d="M18 20V10M12 20V4M6 20v-6"/></svg></div>
					<div class="service-nav-text">
						<h3 class="service-nav-title"><?php esc_html_e( 'Data Platforms', 'codenatives' ); ?></h3>
						<p class="service-nav-subtitle"><?php esc_html_e( 'Lakehouse architectures & real-time pipelines', 'codenatives' ); ?></p>
					</div>
				</div>
				<div class="service-nav-item" data-service="3">
					<div class="service-nav-icon"><svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="M9 12l2 2 4-4"/></svg></div>
					<div class="service-nav-text">
						<h3 class="service-nav-title"><?php esc_html_e( 'Cyber Security', 'codenatives' ); ?></h3>
						<p class="service-nav-subtitle"><?php esc_html_e( 'Zero-trust frameworks & threat intelligence', 'codenatives' ); ?></p>
					</div>
				</div>
				<div class="service-nav-item" data-service="4">
					<div class="service-nav-icon"><svg viewBox="0 0 24 24"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg></div>
					<div class="service-nav-text">
						<h3 class="service-nav-title"><?php esc_html_e( 'Digital Engineering', 'codenatives' ); ?></h3>
						<p class="service-nav-subtitle"><?php esc_html_e( 'API-first architecture & app modernization', 'codenatives' ); ?></p>
					</div>
				</div>
				<div class="service-nav-item" data-service="5">
					<div class="service-nav-icon"><svg viewBox="0 0 24 24"><polyline points="23 4 23 10 17 10"/><polyline points="1 20 1 14 7 14"/><path d="M3.51 9a9 9 0 0114.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0020.49 15"/></svg></div>
					<div class="service-nav-text">
						<h3 class="service-nav-title"><?php esc_html_e( 'Managed AI', 'codenatives' ); ?></h3>
						<p class="service-nav-subtitle"><?php esc_html_e( 'AIOps & continuous optimization', 'codenatives' ); ?></p>
					</div>
				</div>
			</div>

			<!-- Right Column: Card Grid -->
			<div class="services-cards-col">
				<div class="service-explore-card highlighted" data-service="0">
					<img src="<?php echo $img; ?>/unsplash/photo-1677442136019-21780ecad995.jpg" alt="<?php esc_attr_e( 'AI systems and enterprise intelligence', 'codenatives' ); ?>" class="card-bg">
					<div class="card-overlay"></div>
					<div class="card-content">
						<h4><?php esc_html_e( 'AI Systems', 'codenatives' ); ?></h4>
						<div class="card-details">
							<p><?php esc_html_e( 'Autonomous agent architectures, enterprise copilot systems, and knowledge intelligence platforms that execute decisions at machine speed.', 'codenatives' ); ?></p>
							<a href="<?php echo esc_url( home_url( '/solutions/ai-platforms/' ) ); ?>" class="read-more"><?php esc_html_e( 'Learn more', 'codenatives' ); ?> <span>&rarr;</span></a>
						</div>
					</div>
				</div>
				<div class="service-explore-card" data-service="1">
					<img src="<?php echo $img; ?>/unsplash/photo-1451187580459-43490279c0fa.jpg" alt="<?php esc_attr_e( 'Cloud infrastructure and global network', 'codenatives' ); ?>" class="card-bg">
					<div class="card-overlay"></div>
					<div class="card-content">
						<h4><?php esc_html_e( 'Cloud Platforms', 'codenatives' ); ?></h4>
						<div class="card-details">
							<p><?php esc_html_e( 'Multi-cloud fabric architectures with Kubernetes control planes, platform engineering, and edge deployment systems for global operations.', 'codenatives' ); ?></p>
							<a href="<?php echo esc_url( home_url( '/solutions/cloud-platforms/' ) ); ?>" class="read-more"><?php esc_html_e( 'Learn more', 'codenatives' ); ?> <span>&rarr;</span></a>
						</div>
					</div>
				</div>
				<div class="service-explore-card" data-service="2">
					<img src="<?php echo $img; ?>/unsplash/photo-1551288049-bebda4e38f71.jpg" alt="<?php esc_attr_e( 'Data analytics dashboard visualization', 'codenatives' ); ?>" class="card-bg">
					<div class="card-overlay"></div>
					<div class="card-content">
						<h4><?php esc_html_e( 'Data Platforms', 'codenatives' ); ?></h4>
						<div class="card-details">
							<p><?php esc_html_e( 'Modern data stacks, lakehouse architectures, and real-time pipelines that convert raw signals into predictive intelligence.', 'codenatives' ); ?></p>
							<a href="<?php echo esc_url( home_url( '/solutions/data-platforms/' ) ); ?>" class="read-more"><?php esc_html_e( 'Learn more', 'codenatives' ); ?> <span>&rarr;</span></a>
						</div>
					</div>
				</div>
				<div class="service-explore-card" data-service="3">
					<img src="<?php echo $img; ?>/unsplash/photo-1518770660439-4636190af475.jpg" alt="<?php esc_attr_e( 'Cybersecurity circuit board technology', 'codenatives' ); ?>" class="card-bg">
					<div class="card-overlay"></div>
					<div class="card-content">
						<h4><?php esc_html_e( 'Cyber Security', 'codenatives' ); ?></h4>
						<div class="card-details">
							<p><?php esc_html_e( 'Zero-trust frameworks, cloud security posture management, and threat intelligence operations for continuous enterprise protection.', 'codenatives' ); ?></p>
							<a href="<?php echo esc_url( home_url( '/solutions/cyber-security/' ) ); ?>" class="read-more"><?php esc_html_e( 'Learn more', 'codenatives' ); ?> <span>&rarr;</span></a>
						</div>
					</div>
				</div>
				<div class="service-explore-card" data-service="4">
					<img src="<?php echo $img; ?>/unsplash/photo-1461749280684-dccba630e2f6.jpg" alt="<?php esc_attr_e( 'Software code on developer screen', 'codenatives' ); ?>" class="card-bg">
					<div class="card-overlay"></div>
					<div class="card-content">
						<h4><?php esc_html_e( 'Digital Engineering', 'codenatives' ); ?></h4>
						<div class="card-details">
							<p><?php esc_html_e( 'API-first architectures, SaaS product engineering, and intelligent workflow automation that modernize enterprise application estates.', 'codenatives' ); ?></p>
							<a href="<?php echo esc_url( home_url( '/solutions/digital-engineering/' ) ); ?>" class="read-more"><?php esc_html_e( 'Learn more', 'codenatives' ); ?> <span>&rarr;</span></a>
						</div>
					</div>
				</div>
				<div class="service-explore-card" data-service="5">
					<img src="<?php echo $img; ?>/unsplash/photo-1558494949-ef010cbdcc31.jpg" alt="<?php esc_attr_e( 'Data center server room operations', 'codenatives' ); ?>" class="card-bg">
					<div class="card-overlay"></div>
					<div class="card-content">
						<h4><?php esc_html_e( 'Managed AI', 'codenatives' ); ?></h4>
						<div class="card-details">
							<p><?php esc_html_e( 'AIOps, model monitoring, performance optimization, and security operations that keep intelligent systems running reliably at scale.', 'codenatives' ); ?></p>
							<a href="<?php echo esc_url( home_url( '/solutions/managed-ai/' ) ); ?>" class="read-more"><?php esc_html_e( 'Learn more', 'codenatives' ); ?> <span>&rarr;</span></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Section: Parallax — Execution Focus -->
<section class="parallax-section">
	<img src="<?php echo $img; ?>/unsplash/photo-1504384308090-c894fdcc538d.jpg" alt="<?php esc_attr_e( 'Enterprise technology operations', 'codenatives' ); ?>" class="parallax-bg">
	<div class="parallax-overlay"></div>
	<div class="parallax-content cn-container cn-w-full">
		<div style="max-width: 42rem;">
			<span class="section-label" style="color: #60a5fa;"><?php esc_html_e( 'Our Approach', 'codenatives' ); ?></span>
			<h2 class="cn-text-3xl cn-lg-text-4xl cn-font-black cn-mt-3 cn-mb-6" style="color: #fff; line-height: 1.15;"><?php echo wp_kses_post( __( 'We Don\'t Just Advise.<br>We <span class="text-gradient">Architect and Deliver</span>.', 'codenatives' ) ); ?></h2>
			<p style="color: #94a3b8; font-size: 1.05rem; line-height: 1.8; font-weight: 300; margin-bottom: 28px;">
				<?php esc_html_e( 'Most consultancies hand over a strategy deck and leave. We stay through integration, testing, deployment, and optimization. Every engagement produces operational systems, not slide decks.', 'codenatives' ); ?>
			</p>
			<div class="cn-grid cn-grid-cols-2 cn-sm-grid-cols-4 cn-gap-6 cn-mt-8">
				<div class="cn-text-center">
					<div class="stat-number text-gradient" data-count="150" data-suffix="+">0+</div>
					<div style="font-size: 0.8rem; color: #94a3b8;"><?php esc_html_e( 'Enterprise Engagements', 'codenatives' ); ?></div>
				</div>
				<div class="cn-text-center">
					<div class="stat-number text-gradient" data-count="40" data-suffix="+">0+</div>
					<div style="font-size: 0.8rem; color: #94a3b8;"><?php esc_html_e( 'Fortune 500 Clients', 'codenatives' ); ?></div>
				</div>
				<div class="cn-text-center">
					<div class="stat-number text-gradient" data-count="7" data-suffix="">0</div>
					<div style="font-size: 0.8rem; color: #94a3b8;"><?php esc_html_e( 'Countries Deployed', 'codenatives' ); ?></div>
				</div>
				<div class="cn-text-center">
					<div class="stat-number text-gradient" data-count="98" data-suffix="%">0%</div>
					<div style="font-size: 0.8rem; color: #94a3b8;"><?php esc_html_e( 'Client Retention', 'codenatives' ); ?></div>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Section: Industries We Transform -->
<section class="cn-section animate-on-scroll" style="background: var(--bg-primary);">
	<div class="cn-container">
		<div class="cn-text-center cn-mb-16">
			<span class="section-label"><?php esc_html_e( 'Industries', 'codenatives' ); ?></span>
			<h2 class="section-title cn-mt-3"><?php esc_html_e( 'Sector-Specific Transformation at Enterprise Scale', 'codenatives' ); ?></h2>
			<p class="section-subtitle"><?php esc_html_e( 'Deep domain expertise across regulated, high-complexity industries where generic solutions fail.', 'codenatives' ); ?></p>
		</div>

		<div class="cn-grid cn-sm-grid-cols-2 cn-lg-grid-cols-3 cn-gap-8">
			<a href="<?php echo esc_url( home_url( '/industries/healthcare/' ) ); ?>" class="industry-card">
				<div class="industry-card-icon"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg></div>
				<h3><?php esc_html_e( 'Healthcare', 'codenatives' ); ?></h3>
				<p><?php esc_html_e( 'Clinical workflow intelligence, regulatory compliance automation, and patient experience platforms.', 'codenatives' ); ?></p>
				<span class="read-more" style="color: var(--accent-blue); font-size: 0.85rem; font-weight: 600;"><?php esc_html_e( 'Explore', 'codenatives' ); ?> &#8594;</span>
			</a>
			<a href="<?php echo esc_url( home_url( '/industries/manufacturing/' ) ); ?>" class="industry-card">
				<div class="industry-card-icon"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 010 2.83 2 2 0 01-2.83 0l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-4 0v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83-2.83l.06-.06A1.65 1.65 0 004.68 15a1.65 1.65 0 00-1.51-1H3a2 2 0 010-4h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 012.83-2.83l.06.06A1.65 1.65 0 009 4.68a1.65 1.65 0 001-1.51V3a2 2 0 014 0v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 2.83l-.06.06A1.65 1.65 0 0019.4 9a1.65 1.65 0 001.51 1H21a2 2 0 010 4h-.09a1.65 1.65 0 00-1.51 1z"/></svg></div>
				<h3><?php esc_html_e( 'Manufacturing', 'codenatives' ); ?></h3>
				<p><?php esc_html_e( 'Predictive maintenance systems, production optimization, and smart factory orchestration.', 'codenatives' ); ?></p>
				<span class="read-more" style="color: var(--accent-blue); font-size: 0.85rem; font-weight: 600;"><?php esc_html_e( 'Explore', 'codenatives' ); ?> &#8594;</span>
			</a>
			<a href="<?php echo esc_url( home_url( '/industries/supply-chain/' ) ); ?>" class="industry-card">
				<div class="industry-card-icon"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg></div>
				<h3><?php esc_html_e( 'Supply Chain', 'codenatives' ); ?></h3>
				<p><?php esc_html_e( 'End-to-end visibility platforms, demand forecasting engines, and autonomous logistics systems.', 'codenatives' ); ?></p>
				<span class="read-more" style="color: var(--accent-blue); font-size: 0.85rem; font-weight: 600;"><?php esc_html_e( 'Explore', 'codenatives' ); ?> &#8594;</span>
			</a>
			<a href="<?php echo esc_url( home_url( '/industries/financial-services/' ) ); ?>" class="industry-card">
				<div class="industry-card-icon"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg></div>
				<h3><?php esc_html_e( 'Financial Services', 'codenatives' ); ?></h3>
				<p><?php esc_html_e( 'Risk modeling platforms, regulatory reporting automation, and fraud detection architectures.', 'codenatives' ); ?></p>
				<span class="read-more" style="color: var(--accent-blue); font-size: 0.85rem; font-weight: 600;"><?php esc_html_e( 'Explore', 'codenatives' ); ?> &#8594;</span>
			</a>
			<a href="<?php echo esc_url( home_url( '/industries/human-resources/' ) ); ?>" class="industry-card">
				<div class="industry-card-icon"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg></div>
				<h3><?php esc_html_e( 'Human Resources', 'codenatives' ); ?></h3>
				<p><?php esc_html_e( 'Talent intelligence platforms, workforce planning automation, and employee experience systems.', 'codenatives' ); ?></p>
				<span class="read-more" style="color: var(--accent-blue); font-size: 0.85rem; font-weight: 600;"><?php esc_html_e( 'Explore', 'codenatives' ); ?> &#8594;</span>
			</a>
			<a href="<?php echo esc_url( home_url( '/solutions/innovation-lab/' ) ); ?>" class="industry-card" style="background: #0a0e1a; border-color: rgba(255,255,255,0.08); color: #fff;">
				<div class="industry-card-icon" style="color: #facc15;"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18h6"/><path d="M10 22h4"/><path d="M15.09 14c.18-.98.65-1.74 1.41-2.5A4.65 4.65 0 0018 8 6 6 0 006 8c0 1 .23 2.23 1.5 3.5C8.26 12.26 8.73 13.02 8.91 14"/><line x1="9" y1="18" x2="9" y2="14"/><line x1="15" y1="18" x2="15" y2="14"/></svg></div>
				<h3 style="color: #fff;"><?php esc_html_e( 'Innovation Lab', 'codenatives' ); ?></h3>
				<p style="color: #94a3b8;"><?php esc_html_e( 'Where emerging technologies become enterprise-grade capabilities. Proof of concept to production.', 'codenatives' ); ?></p>
				<span class="read-more" style="color: var(--accent-green); font-size: 0.85rem; font-weight: 600;"><?php esc_html_e( 'Explore Lab', 'codenatives' ); ?> &#8594;</span>
			</a>
		</div>
	</div>
</section>

<!-- CogentAI Platform -->
<section class="cn-section animate-on-scroll" style="background: var(--bg-secondary);">
	<div class="cn-container">
		<div class="cn-grid cn-lg-grid-cols-5 cn-gap-12 cn-items-center">
			<div class="cn-lg-col-span-4">
				<span class="section-label"><?php esc_html_e( 'Our Platform', 'codenatives' ); ?></span>
				<h2 class="section-title cn-mt-3"><?php esc_html_e( 'Enterprise AI Agents That Operate Within Your Infrastructure', 'codenatives' ); ?></h2>
				<p style="font-size: 1.05rem; color: var(--text-secondary); line-height: 1.8; font-weight: 300; margin-top: 16px;">
					<?php esc_html_e( 'CogentAI is our language-model-agnostic agents platform built for complex business process automation. It embeds intelligent agents directly into your existing enterprise workflows — SAP, Salesforce, Microsoft 365, Oracle, and more — while keeping all data exactly where it resides. No migration. No vendor lock-in. Complete operational sovereignty.', 'codenatives' ); ?>
				</p>
				<div class="cn-mt-6">
					<a href="<?php echo esc_url( home_url( '/platform/' ) ); ?>" class="btn-main"><?php esc_html_e( 'Explore the Platform', 'codenatives' ); ?> <span>&#8594;</span></a>
				</div>
			</div>
			<div class="cn-lg-col-span-1 cn-flex cn-justify-center cn-lg-justify-end">
				<img src="<?php echo $img; ?>/platform/cogentai-logo-dark.svg" alt="CogentAI" class="nav-logo-light" style="max-width: 160px; width: 100%;">
				<img src="<?php echo $img; ?>/platform/cogentai-logo-light.svg" alt="CogentAI" class="nav-logo-dark" style="max-width: 160px; width: 100%;">
			</div>
		</div>
	</div>
</section>

<!-- CTA Section -->
<section class="cn-section-sm" style="background: var(--bg-primary);">
	<div class="cn-container">
		<div class="cta-connect-box">
			<div class="cta-connect-text">
				<h2><?php echo wp_kses_post( __( '<span class="cta-connect-bold">Navigate</span> the next steps<br>ahead with us! <span class="cta-arrow">&#8599;</span>', 'codenatives' ) ); ?></h2>
				<p class="cta-connect-subtitle"><?php esc_html_e( 'Ready to ignite your progress?', 'codenatives' ); ?></p>
				<div class="cta-connect-actions">
					<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="cta-talk-btn"><?php esc_html_e( "LET'S TALK!", 'codenatives' ); ?></a>
				</div>
			</div>
			<div class="cta-connect-image">
				<img src="<?php echo $img; ?>/content/stand-out-2048x1529.png" alt="<?php esc_attr_e( 'Stand out with Codenatives', 'codenatives' ); ?>">
			</div>
		</div>
	</div>
</section>
