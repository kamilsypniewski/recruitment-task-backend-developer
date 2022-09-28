<?php

declare(strict_types=1);

namespace App\Tests\Components\Articles\Fixtures;

use DateTimeImmutable;
use DateTimeZone;

trait States
{

    protected function getArticleResponse(
        ?string $pubDate = null,
        ?string $headlineMain = null,
        ?string $leadParagraph = null,
        ?string $webUrl = null,
        ?string $sectionName = null,
        ?string $subsectionName = null,
        ?string $multimediaSubType = null,

    ): array
    {
        return [
            "pub_date" => $pubDate ?? $this->dateNow()->format('Y-m-d'),
            "headline"=> [
                "main" => $headlineMain ?? $this->string()
            ],
            "lead_paragraph" => $leadParagraph ?? $this->string(),
            "web_url" => $webUrl ?? $this->string(),
            "section_name" => $sectionName ?? $this->string(),
            "subsection_name" => $subsectionName ?? $this->string(),
            "multimedia" => [
                [
                    "subtype"=> $multimediaSubType ?? $this->string(),
                ]
            ],
        ];
    }


    protected function string(): string
    {
        return \uniqid('', true);
    }


    protected function bool(): bool
    {
        return $this->int() > 0;
    }

    protected function int(): int
    {
        return \random_int(PHP_INT_MIN, PHP_INT_MAX);
    }

    protected function float(): float
    {
        return (float) $this->int();
    }

    protected function dateNow(): DateTimeImmutable
    {
        return new DateTimeImmutable('now', new DateTimeZone('UTC'));
    }
}
