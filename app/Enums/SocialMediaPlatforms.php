<?php

namespace App\Enums;

enum SocialMediaPlatforms: string
{
    case X = 'x';
    case Mastodon = 'mastodon';
    case Facebook = 'facebook';
    case Instagram = 'instagram';
    case LinkedIn = 'linkedin';
    case LinkedInCompany = 'linkedin-company';
    case YouTube = 'youtube';
    case Twitch = 'twitch';
    case TikTok = 'tiktok';
    case GitHub = 'github';
    case GitLab = 'gitlab';
    case Bitbucket = 'bitbucket';
    case Reddit = 'reddit';

    public static function getOptions(): array
    {
        return array_column(self::cases(), 'name', 'value');
    }

    public function getDefaultUrl(): string
    {
        return match ($this) {
            self::X => 'https://x.com/',
            self::Mastodon => 'https://mastodon.social/',
            self::Facebook => 'https://facebook.com/',
            self::Instagram => 'https://instagram.com/',
            self::LinkedIn => 'https://linkedin.com/in/',
            self::LinkedInCompany => 'https://linkedin.com/company/',
            self::YouTube => 'https://youtube.com/',
            self::Twitch => 'https://twitch.tv/',
            self::TikTok => 'https://tiktok.com/',
            self::GitHub => 'https://github.com/',
            self::GitLab => 'https://gitlab.com/',
            self::Bitbucket => 'https://bitbucket.org',
            self::Reddit => 'https://reddit.com',
        };
    }

    public function getSiteDefaultLogo(): string
    {
        return match ($this) {
            self::X => 'images/socials/x.webp',
            self::Mastodon => 'images/socials/mastodon.webp',
            self::Facebook => 'images/socials/facebook.webp',
            self::LinkedIn => 'images/socials/linkedin.webp',
            self::LinkedInCompany => 'images/socials/linkedin-company.webp',
            self::YouTube => 'images/socials/youtube.webp',
            self::GitHub => 'images/socials/github.png',
            default => 'images/socials/default.webp',
        };
    }

    public static function toArray(): array
    {
        return array_map(fn ($case) => $case->value, self::cases());
    }

    public static function toNestedArray(): array
    {
        return array_map(fn ($case) => [$case->value], self::cases());
    }

    public static function getValues(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function getCaseNames(): array
    {
        return array_column(self::cases(), 'name');
    }
}
