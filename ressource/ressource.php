<script language="php">
// ######################################################################
//
// Path: /usr/local/php/includes/ressource/ressource.php
//
// ######################################################################

// ######################################################################
// --- REQUIRES
// ######################################################################

// ######################################################################
// --- CONSTANTS
// ######################################################################


/**
 *
 * @author: Arno Mittelbach <arno@mittelbach-online.de>
 * @version: 0.1
 * @access:  public
 * @package: ressource
 */
class ressource
  {
    
    private $m_aszRessource;

    function __construct( $szPath )
      {
	$this->readFile( $szPath );
      }

    private function readFile( $szPath )
      {
	$aszFile = file( $szPath . '.res' );
	
	$szLang = '';

	foreach( $aszFile as $szLine )
	  {
	    switch( substr( $szLine, 0, 1 ) )
	      {
	      case '#':
		next;
		break;
	      case '[':
		$szLang = substr( $szLine, 1, strpos( $szLine, ']' ) - 1);
		break;
	      default:
		list( $key, $value ) = explode( '=', $szLine, 2 );
		$this->m_aszRessource[ $szLang ][ $key ] = $value;
		break;
	      }
	  }
      }

    public function getString( $szLang, $szString, &$szReturn )
      {
	$szReturn = $this->m_aszRessource[ $szLang ][ $szString ];	
      }
  }