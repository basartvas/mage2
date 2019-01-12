<?php

namespace Academy\Lesson7\Api\Data;

interface NewsInterface
{
    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @return string
     */
    public function getIdentifier(): string;

    /**
     * @param string $identifier
     * @return mixed
     */
    public function setIdentifier(string $identifier);

    /**
     * @return string
     */
    public function getTitle(): string;

    /**
     * @param string $title
     * @return mixed
     */
    public function setTitle(string $title);

    /**
     * @return string
     */
    public function getContent(): string;

    /**
     * @param string $content
     * @return mixed
     */
    public function setContent(string $content);

    /**
     * @return string
     */
    public function getAuthor(): string;

    /**
     * @param string $author
     * @return mixed
     */
    public function setAuthor(string $author);

    /**
     * @return string
     */
    public function getCreationTime(): string;

    /**
     * @return string
     */
    public function getUpdateTime(): string;

    /**
     * @return bool
     */
    public function getIsActive(): bool;

    /**
     * @param bool $isActive
     * @return mixed
     */
    public function setIsActive(bool $isActive);

    /**
     * @return int
     */
    public function getSortOrder(): int;

    /**
     * @param int $sortOrder
     * @return mixed
     */
    public function setSortOrder(int $sortOrder);
}