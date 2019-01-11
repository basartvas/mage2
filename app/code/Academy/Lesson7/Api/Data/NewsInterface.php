<?php
namespace Academy\Lesson7\Api\Data;

interface NewsInterface
{
    public function getId(): int;
    public function getIdentifier(): string;
    public function setIdentifier(string $identifier);
    public function getTitle(): string;
    public function setTitle(string $title);
    public function getContent(): string;
    public function setContent(string $content);
    public function getAuthor(): string;
    public function setAuthor(string $author);
    public function getCreationTime(): string;
    public function getUpdateTime(): string;
    public function getIsActive(): bool;
    public function setIsActive(bool $isActive);
    public function getSortOrder(): int;
    public function setSortOrder(int $sortOrder);
}