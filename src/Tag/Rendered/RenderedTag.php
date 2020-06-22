<?php

declare(strict_types=1);

namespace Setono\TagBag\Tag\Rendered;

use Setono\TagBag\Tag\TagInterface;

/**
 * This class is not intended to be used outside the TagBag class.
 *
 * The reason for having a RenderedTag is that tags implementing the TagInterface can in theory have all sorts of
 * dependencies which in turn makes it harder to serialize, and the tag bag is serialized upon storing it
 */
final class RenderedTag
{
    /** @var string */
    private $name;

    /** @var string */
    private $value;

    /** @var int */
    private $priority;

    /** @var string */
    private $section;

    /** @var string[] */
    private $dependencies;

    private function __construct(string $name, string $value, int $priority, string $section, array $dependencies)
    {
        $this->name = $name;
        $this->value = $value;
        $this->priority = $priority;
        $this->section = $section;
        $this->dependencies = $dependencies;
    }

    public static function createFromTag(TagInterface $tag, string $value): self
    {
        return new self($tag->getName(), $value, $tag->getPriority(), $tag->getSection(), $tag->getDependencies());
    }

    public function __toString(): string
    {
        return $this->getValue();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function getPriority(): int
    {
        return $this->priority;
    }

    public function getSection(): string
    {
        return $this->section;
    }

    public function getDependencies(): array
    {
        return $this->dependencies;
    }
}
