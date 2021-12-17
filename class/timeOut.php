<?php

class timeOut implements JsonSerializable
{
	private $ip;
	private $dateOfTimeOut;
	public function __construct($ip, $dateOfTimeOut)
	{
		$this->ip = $ip;
		$this->dateOfTimeOut = $dateOfTimeOut;
	}

	public function jsonSerialize(): array
	{
		return [
			'ip' => $this->ip,
			'dateOfTimeOut' => $this->dateOfTimeOut
		];
	}

}