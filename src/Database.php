<?php
class Database
{
//private string $host;

public function __construct(
  private  string $host,
  private string $name,
  private  string $user,
  private    string $password
){
      //  $this->host = $host;
}
public function getConnection(): PDO
{
        $dsn = "mysql:host={$this->host};dbname={$this->name};charset=utf8";

        RETURN new PDO($dsn, $this->user, $this->password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
}
}