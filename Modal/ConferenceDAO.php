<?php

namespace Database;

require_once 'DBManager.php';
require_once 'Entity/Conference.php';

class ConferenceDAO
{
    private static string $findAll = "SELECT * FROM Conferences INNER JOIN Countries ON Countries.country_id=Conferences.country;";
    private static string $removeRec = "DELETE FROM Conferences WHERE id=:id;";
    private static string $createRec = "INSERT INTO Conferences(title, dates, Latitude, Longitude,country)" .
                                        " VALUES(:title,:date , :latitude , :longitude , :country);";
    private static string $createRecWithoutAddress = "INSERT INTO Conferences(title, dates,country)" .
    " VALUES(:title,:date, :country);";
    private static string $findOne = "SELECT * FROM Conferences INNER JOIN Countries ON Countries.country_id=Conferences.country where id=:id;";
    private static string $updateInfo = "UPDATE conferences t
                                            SET t.title     = :title,
                                                t.dates     = :dates,
                                                t.Latitude  = :latitude,
                                                t.Longitude = :longitude,
                                                t.country   = :country
                                            WHERE t.id = :id;";
    private static string $updateInfoWithoutAddress = "UPDATE conferences t
                                            SET t.title     = :title,
                                                t.dates     = :dates,
                                                t.country   = :country
                                            WHERE t.id = :id;";

    private DBManager $DBManager;

    public function __construct()
    {
        $this->DBManager = DBManager::getInstance();
    }

    public function getAll(): array
    {
        $result = $this->DBManager->query(ConferenceDAO::$findAll);
        $conferences = array();
        foreach ($result as $key => $value){
            $conference = new Conference();
            $conference->setId($value['id']);
            $conference->setTitle($value['title']);
            $conference->setDates($value['dates']);
            $conference->setLatitude($value['Latitude']);
            $conference->setLongitude($value['Longitude']);
            $conference->setCountry($value['country']);

            $conferences[] = $conference;
        }

        return $conferences;
    }

    public function removeRecord($id): void
    {
        $sth = $this->DBManager->getDbn()->prepare(ConferenceDAO::$removeRec);
        $sth->bindValue(':id', $id);

        $sth->execute();
    }

    public function createRecord($title, $date, $country, $latitude, $longitude): void
    {
        $sth = $this->DBManager->getDbn()->prepare(ConferenceDAO::$createRec);
        $sth->bindValue(':title', $title);
        $sth->bindValue(':date', $date);
        $sth->bindValue(':country', $country);
        $sth->bindValue(':latitude', $latitude);
        $sth->bindValue(':longitude', $longitude);

        $sth->execute();
    }

    public function createRecordWithoutAddress($title, $date, $country): void
    {
        $sth = $this->DBManager->getDbn()->prepare(ConferenceDAO::$createRecWithoutAddress);
        $sth->bindValue(':title', $title);
        $sth->bindValue(':date', $date);
        $sth->bindValue(':country', $country);

        $sth->execute();
    }

    public function getOneById($id): ?Conference
    {
        $sth = $this->DBManager->getDbn()->prepare(ConferenceDAO::$findOne);
        $sth->bindValue(':id', $id);

        $sth->execute();

        $result = $sth->fetchAll(\PDO::FETCH_ASSOC);

        if ($result === false){
            return null;
        }
        $conference = new Conference();

        foreach ($result as $key => $value) {
            $conference->setId($value['id']);
            $conference->setTitle($value['title']);
            $conference->setDates($value['dates']);
            $conference->setLatitude($value['Latitude']);
            $conference->setLongitude($value['Longitude']);
            $conference->setCountry($value['country']);
        }

        return $conference;
    }

    public function refactorRecord($id, $title, $date, $country, $latitude, $longitude): void
    {
        $sth = $this->DBManager->getDbn()->prepare(ConferenceDAO::$updateInfo);
        $sth->bindValue(':title', $title);
        $sth->bindValue(':dates', $date);
        $sth->bindValue(':country', $country);
        $sth->bindValue(':latitude', $latitude);
        $sth->bindValue(':longitude', $longitude);
        $sth->bindValue(':id', $id);


        $sth->execute();
    }
}