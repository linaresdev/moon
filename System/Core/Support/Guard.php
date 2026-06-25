<?php
namespace Moon\Core\Support;

class Guard {

	protected $app;

    protected static $IP;

    protected static $IPS;

    protected static $AGENT;

	public function __construct() {
        self::$IP       = request()->ip();
        self::$IPS      = request()->ips();
        self::$AGENT    = request()->userAgent();
	}

	public function lists($agent=NULL) {
		return [
			"os" => $this->platform($agent),
			"browser" => $this->browser($agent),
			"robot" => $this->robot($agent),
			"mobil" => $this->mobil($agent),
			"device" => $this->device($agent),
		];
	}

	public function platform($agent=NULL) {

		if(empty($agent)) $agent = self::$AGENT;

		if( !empty( ($platforms = (new GuardList)->platforms()) ) )
		{
			foreach ($platforms as $key => $value) {
				if ( preg_match('|'.preg_quote($key).'|i', $agent) ) {
					return $value;
				}
			}
		}

		return 'Unknown Platform';
	}

	public function browser($agent=null) {
        
		if( empty($agent) ) $agent = self::$AGENT;

		if( !empty( ($browsers = (new GuardList)->browsers()) ) && is_array($browsers) ) {
			foreach ($browsers as $key => $value) {
				if (preg_match('|'.$key.'.*?([0-9\.]+)|i', $agent, $match)) {
					return $value.' | V-'.$match[1]; 
				}
			}
		}

		return 'Unknown Browser'; 
	}

	public function robot($agent=null) {
		if(empty($agent)) $agent = self::$AGENT;

		if( !empty( ($robots = (new GuardList)->robots()) ) && is_array($robots) ) {
			foreach ($robots as $key => $value) {
				if (preg_match('|'.preg_quote($key).'|i', $agent, $match))
				{
					return $value; 
				}
			}
		} 
	}

	public function mobil($agent=NULL) {
		if(empty($agent)) $agent = self::$AGENT;
		
		if( !empty( ($mobiles = (new GuardList)->mobiles()) ) && is_array($mobiles) ) {
			foreach ($mobiles as $key => $value) {
				if( preg_match('|'.preg_quote($key).'|i', $agent, $match) ) {
					return $value; 
				}
			}
		}

		return "It is not a Mobile";
	}

	public function device( $agent=null ) {

        if(empty($agent)) $agent = self::$AGENT;

		if( !empty( $agent) ) {
			if( !empty( ($mobiles = (new GuardList)->mobiles()) ) && is_array($mobiles) ) {
				foreach ($mobiles as $key => $value) {
					if( preg_match('|'.preg_quote($key).'|i', $agent, $match) ) {
						return "Smartphone"; 
					}
				}
			}

			return "Computer";
		}

		return 'Unknown Device';
	}

}