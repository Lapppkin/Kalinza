<?php

declare(strict_types=1);

namespace core;

class Codex
{
    public const PERMISSION_DENY  = 'D';
    public const PERMISSION_READ  = 'R';
    public const PERMISSION_WRITE = 'W';
    public const PERMISSION_FULL  = 'X';
    public const PERMISSION_DOC   = 'U';

    public const SITE_ID_MAIN = 's1';

    public const GROUP_ID_ADMIN           = 1; // ��������������
    public const GROUP_ID_ALL             = 2; // ��� ������������ (� ��� ����� ����������������)
    public const GROUP_ID_RATE_RIGHT      = 3; // ������������, ������� ����� ���������� �� �������
    public const GROUP_ID_AUTHORITY_RIGHT = 4; // ������������ ������� ����� ���������� �� ���������
}
