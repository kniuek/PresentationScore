<?php

namespace Kni\User\Model;

class User
{
	protected $id;
	protected $login;
	protected $password;

	/**
     * @return mixed
     */
	public function getId()
	{
		return $this->id;
	}

	/**
     * @return mixed $id
     */
	public function setId()
	{
		$this->id=$id
	}

	/**
     * @return mixed
     */
	public function getLogin()
	{
		return $this->login;
	}

	/**
     * @return mixed $login
     */
	public function setLogin()
	{
		$this->login=$login;
	}

	/**
     * @return mixed
     */
	public function getPassword()
	{
		return $this->password;
	}

	/**
     * @return mixed $password
     */
	public function setPassword()
	{
		$this->password=$password;
	}

}

?>
