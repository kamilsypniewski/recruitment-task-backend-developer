<?php

declare(strict_types=1);

namespace App\Tests\Components\ArticleSearchApi\Fixtures;

use DateTimeImmutable;
use DateTimeZone;

trait States
{
    protected function response(int $responseCode = 200, ?string $text = ''): \GuzzleHttp\Psr7\Response
    {
        $stream = json_encode($text ?? $this->string());
        return new \GuzzleHttp\Psr7\Response($responseCode, ['Content-Type' => 'application/json'], $stream);
    }

    protected function contents(array $docs = []): string
    {
        return json_encode([
            'response'=> [
                'docs'=> $docs
            ]
        ]);
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
