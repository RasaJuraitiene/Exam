<?php


namespace App\Feedbacks;


class Feedback
{
    private $data = [];

    public function __construct($data = null)
    {
        if ($data) {
            $this->setData($data);
        } else {
            $this->data = [
                'id' => null,
                'review' => null,
                'timestamp' => null,
            ];
        }
    }

    /**
     * * Sets all data from array
     * @param $array
     */
    public function setData($array)
    {
        if (isset($array['id'])) {
            $this->setId($array['id']);
        } else {
            $this->data['id'] = null;
        }
        $this->setReview($array['review'] ?? null);
        $this->setTimestamp($array['timestamp'] ?? null);
    }

    /**
     * Gets all data as array
     * @return array
     */
    public function getData()
    {
        return [
            'id' => $this->getId(),
            'review' => $this->getReview(),
            'timestamp' => $this->getTimestamp()
        ];
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->data['id'] = $id;
    }

    /**
     * @return int|null
     */
    public function getId()
    {
        return $this->data['id'];
    }

    /**
     * Sets name
     * @param string $review
     */
    public function setReview(string $review)
    {
        $this->data['review'] = $review;
    }

    /**
     * Returns review
     * @return string
     */
    public function getReview()
    {
        return $this->data['review'] ?? null;
    }

    /**
     * Sets data timestamp
     *
     * @param string $timestamp
     */
    public function setTimestamp(int $timestamp)
    {
        $this->data['timestamp'] = $timestamp;
    }

    /**
     * @return mixed
     */
    public function getTimestamp()
    {
        return $this->data['timestamp'] ?? null;
    }
}
