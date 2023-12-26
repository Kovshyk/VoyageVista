<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     3.0.0
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */

namespace App\View;

use Cake\View\View;
use App\View\Traits\SeoTrait;
use App\View\Traits\LangTrait;
use App\Helpers\ProjectPriceHelper;

/**
 * Application View
 *
 * Your application’s default view class
 *
 * @link http://book.cakephp.org/3.0/en/views.html#the-app-view
 */
class AppView extends View {
	use SeoTrait;
	use LangTrait;

	public function getProjectPrice( $price ) {
		return ProjectPriceHelper::getPrice( $price );
	}


	public function initialize() {
		$this->loadHelper( 'PerfectHTML', [ 'templates' => 'my_html' ] );
		$this->initLang();

	}


	public function getNiceShareUrl( $type, $url ) {
		$shares_erl = [
			'facebook'    => 'https://www.facebook.com/sharer/sharer.php?u=',
			'linkedin'    => 'https://www.linkedin.com/shareArticle?mini=true&url=',
			'pinterest'   => 'https://pinterest.com/pin/create/button/?url=',
			'twitter'     => 'https://www.twitter.com/share?url=',
			'google-plus' => 'https://plus.google.com/share?url=',
			'viber'       => 'viber://forward?text=',
			'whatsapp'    => 'https://web.whatsapp.com/send?text=',
			'telegram'    => 'https://telegram.me/share/url?url=',
		];
		if ( ! array_key_exists( $type, $shares_erl ) ) {
			return '';
		}

		return $shares_erl[ $type ] . $url;
	}

	public function preparePhoneNumber( $phone ) {
		$phone = str_replace( ' ', '', $phone );
		$phone = str_replace( ')', '', $phone );
		$phone = str_replace( '(', '', $phone );

		return $phone;
	}

    public function isCategoryPage() {
        return ( $this->request->param( 'controller' ) === 'Pages' && $this->request->param( 'action' ) === 'category' );
    }

    public function isProjectPage() {
		return ( $this->request->param( 'controller' ) === 'Pages' && $this->request->param( 'action' ) === 'project' );
	}

    public function isProjectsPage() {
        return ( $this->request->param( 'controller' ) === 'Pages' && $this->request->param( 'action' ) === 'projects' );
    }

	public function isBlogCategoryPage() {
		return ( $this->request->param( 'controller' ) === 'Pages' && $this->request->param( 'action' ) === 'blog' );
	}

	public function isBlogPage() {
		return ( $this->request->param( 'controller' ) === 'Pages' && $this->request->param( 'action' ) === 'post' );
	}

	public function detectMobileOperator( $phone ) {
		$operators          = [
			'vodafone' => ['050', '066', '095', '099'],
			'lifecell' => ['063', '073', '093'],
			'kyivstar' => ['067', '068', '096', '097', '098'],
		];
		$phone = str_replace( ' ', '', $phone );
		$phone = str_replace( ')', '', $phone );
		$phone = str_replace( '(', '', $phone );

		$rest = substr( $phone, 0, 3 );
		$del  = 0;
		if ( $rest == '+38' ) {
			$del = 3;
		}
		$rest = substr( $phone, 0, 2 );
		if ( $rest == '38' ) {
			$del = 2;
		}
		if ( $rest == '8' ) {
			$del = 1;
		}
		if ( $del > 0 ) {
			mb_internal_encoding( "UTF-8" );
			$phone = mb_substr( $phone, $del );
		}
		$first_3 = $phone = substr( $phone, 0, 3 );
		if(in_array($first_3, $operators['vodafone'])) {
			return 'vodafone';
		} else if(in_array($first_3, $operators['lifecell'])) {
			return 'lifecell';
		} else if(in_array($first_3, $operators['kyivstar'])) {
			return 'kyivstar';
		}
		return 'unknown';
	}

}
