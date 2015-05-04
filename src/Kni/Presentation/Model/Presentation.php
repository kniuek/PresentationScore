<?php

namespace Kni\Presentation\Model;

use Storage\Model\FileAwareInterface;
use \MongoId;

class Presentation implements FileAwareInterface
{
    protected $id;
    protected $title;
    protected $slug;
    protected $description;
    protected $path;
    protected $file;
    protected $rateCount;
    protected $rateSum;
    protected $comments;
    protected $createdAt;

    public function __construct()
    {
        $now = new \DateTime();
        $this->createdAt = $now->format('Y-m-d H:i');
        $this->rateCount = 0;
        $this->rateSum = 0;
        $this->comments = [];
    }

    /**
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param string $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

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

    public function toArray()
    {
        return [

            'title' => $this->getTitle(),
            'slug' => $this->getSlug(),
            'description' => $this->getDescription(),
            'path' => $this->getPath(),
            'rateCount' => $this->rateCount,
            'rateSum' => $this->rateSum,
            'comments' => $this->commentsToArray(),
            'createdAt' => $this->createdAt,
        ];
    }

    protected function commentsToArray()
    {
        $com = [];

        foreach ($this->comments as $comment) {
            if (is_array($comment)) {
                $com[] = $comment;
            } else {
                $com[] = $comment->toArray();
            }
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

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param mixed $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
        return $this;
    }

}