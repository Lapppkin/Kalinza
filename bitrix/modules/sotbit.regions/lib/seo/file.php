<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 29-Jan-18
 * Time: 3:06 PM
 */

namespace Sotbit\Regions\Seo;

use Bitrix\Main\Result;

abstract class File
{
	/**
	 * @var Result
	 */
	protected $result;
	protected $htaccess;

	public function __construct()
	{
		$this->result = new Result();
		$this->htaccess = $_SERVER['DOCUMENT_ROOT'] . '/.htaccess';
	}

	abstract public function run();

	protected function addFileHeader()
	{
		return '<?php
					use Bitrix\Main\Loader;
					require_once ($_SERVER[\'DOCUMENT_ROOT\'].\'/bitrix/modules/main/include/prolog_before.php\');
					if(!Loader::includeModule("sotbit.regions"))
					{
						return false;
					}
					$domain = new \Sotbit\Regions\Location\Domain();
					$domainCode = $domain->getProp("CODE");
					?>';
	}

	protected function genNewFile($oldFile = '',$content = '')
	{
		$newFile = str_replace(array('.xml','.txt'),'.php',$oldFile);
		if(file_exists($newFile))
		{
			unlink($newFile);
		}
		file_put_contents(
			$newFile,
			$content
		);
		return $newFile;
	}

	protected function addRuleToHtaccess(
		$oldFile = '',
		$newFile = '',
		$site = ''
	)
	{
		if($oldFile && $newFile && file_exists($this->htaccess))
		{
			if($site[0] == '/')
			{
				$site = substr($site,1);
			}
			$htaccess = file_get_contents($this->htaccess);
			if(strpos($htaccess, 'RewriteRule ^' . $site . $oldFile . '$ ' . $site .$newFile . ' [L,QSA]') === false)
			{
				$modRewrite = '<IfModule mod_rewrite.c>';
				$modRewritePos = strpos($htaccess,'<IfModule mod_rewrite.c>');
				if($modRewrite !== false)
				{
					$nhtaccess = substr($htaccess,0,$modRewritePos+strlen($modRewrite));
					$nhtaccess .= "\r\n";
					$nhtaccess .= 'RewriteRule ^' . $site . $oldFile . '$ ' . $site . $newFile . ' [L,QSA]';
					$nhtaccess .= "\r\n";
					$nhtaccess .= substr($htaccess,$modRewritePos+strlen($modRewrite));
					$htaccess = $nhtaccess;
				}
				else
				{
					$htaccess .= "\r\n";
					$htaccess .= 'RewriteRule ^' . $site . $oldFile . '$ ' . $site . $newFile . ' [L,QSA]';
				}
				$i=0;
				while(file_exists($this->htaccess.'.back'.$i))
				{
					++$i;
					if($i > 100)
					{
						break;
					}
				}
				copy($this->htaccess, $this->htaccess.'.back'.$i);
				file_put_contents($this->htaccess, $htaccess);
			}
		}
	}
}