<?php

namespace Kni\Presentation\Model;

use Storage\Model\FileAwareInterface;
use \MongoId;

class Presentation implements FileAwareInterface
{
    protected $id;
    protected $title;
    protected $description;
    protected $path;
    protected $file;
    protected $rateCount;
    protected $rateSum;
    protected $comments;

    /**
     * @return array
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param array $comments
     */
    public function setComments($comments)
    {
        $this->comments = $comments;
        return $this;
    }

    public function addComment($comment)
    {
        $this->comments[] = $comment;
    }

    public function __construct()
    {
        $this->rateCount = 0;
        $this->rateSum = 0;
        $this->comments = [];
    }

    public function toArray()
    {
        return [
            'id' =>  new \MongoId($this->getId()),
            'title' => $this->getTitle(),
            'description' => $this->getDescription(),
            'path' => $this->getPath(),
            'rateCount' => $this->rateCount,
            'rateSum' => $this->rateSum,
            'comments' => $this->commentsToArray()
        ];
    }

    protected function commentsToArray()
    {
        $com = [];

        foreach ($this->comments as $comment) {
            $com[] = $comment->toArray();
        }

        return $com;
    }

    public function rate($vote)
    {
        $this->rateCount++;
        $this->rateSum = $this->rateSum + $vote;
    }


    /**
     * @return mixed
     */
    public function getRateCount()
    {
        return $this->rateCount;
    }

    /**
     * @param mixed $rateCount
     */
    public function setRateCount($rateCount)
    {
        $this->rateCount = $rateCount;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRateSum()
    {
        return $this->rateSum;
    }

    /**
     * @param mixed $rateSum
     */
    public function setRateSum($rateSum)
    {
        $this->rateSum = $rateSum;
        return $this;
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param mixed $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param mixed $file
     */
    public function setFile($file)
    {
        $this->file = $file;
    }


    public function hasFile()
    {
        return $this->file !== null;
    }
}