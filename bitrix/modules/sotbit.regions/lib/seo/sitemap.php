<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 29-Jan-18
 * Time: 3:06 PM
 */

namespace Sotbit\Regions\Seo;

use Bitrix\Main\Error;
use Bitrix\Main\SiteTable;
use Sotbit\Regions\Config\Option;

/**
 * Class Sitemap
 * @package Sotbit\Regions\Seo
 * @author Sergey Danilkin <s.danilkin@sotbit.ru>
 */
class Sitemap extends File
{
	/**
	 * @var string
	 */
	public $dir       = '';
	/**
	 * @var string
	 */
	public $site      = '';
	/**
	 * @var string
	 */
	public $siteDir      = '';
	/**
	 * @var array
	 */
	public $rootFiles = array(
		'sitemap_index.xml',
		'sitemap.xml'
	);

	/**
	 * Sitemap constructor.
	 * @param $siteLid
	 * @throws \Bitrix\Main\ArgumentException
	 */
	public function __construct($siteLid)
	{
		parent::__construct();
		$site = SiteTable::getList(array(
			'filter' => array('LID' => $siteLid),
			'limit' => 1,
			'select' => array('DIR')
		))->fetch();
		$this->site = $siteLid;
		$this->siteDir = $site['DIR'];
		$this->dir = $_SERVER['DOCUMENT_ROOT'] . $site['DIR'];
	}

	/**
	 * @return \Bitrix\Main\Result
	 */
	public function run()
	{
		if(Option::get('SINGLE_DOMAIN',$this->site) != 'Y')
		{
			foreach ($this->rootFiles as $rootFile)
			{
			    $find = false;
				if(file_exists($this->dir . $rootFile))
				{
				    $find = true;
					$xmlRoot = simplexml_load_file($this->dir . $rootFile);
					$newXml = $this->addFileHeader();
					$newXml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

					foreach ($xmlRoot->sitemap as $sitemap)
					{
						$path = explode('/', $sitemap->loc);
						$file = end($path);
						if(file_exists($this->dir . $file))
						{
							$xml = simplexml_load_file($this->dir . $file);
							foreach ($xml->url as $url)
							{
								$newXml .= '<url>';
								$loc = str_replace(array(
									'http://',
									'https://'
								), '', $url->loc);

								$path = explode('/', $loc);
								$root = $path[0];
								$loc = str_replace($root, '', $loc);

								$newXml .= '<loc>' . '<?=$domainCode?>' . $loc . '</loc>';
								$newXml .= '<lastmod>' . $url->lastmod . '</lastmod>';
								$newXml .= '</url>';

							}
						}
					}
					$newXml .= '</urlset>';
					$newFile = $this->genNewFile($this->dir . $rootFile, $newXml);

					$this->addRuleToHtaccess(
						$rootFile,
						str_replace($_SERVER['DOCUMENT_ROOT'] . $this->siteDir, '', $newFile),
						$this->siteDir);
				}
				if(!$find){
                    $error = new Error('',2);
                    $this->result->addError($error);
                }
			}
		}
		else{
		    $error = new Error('',1);
		    $this->result->addError($error);
        }
        return $this->result;
	}
}