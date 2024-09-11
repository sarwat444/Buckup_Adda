<?php

namespace App\Enums;

enum VideoUploadStatus: string
{
    case transcode_starting = 'transcode_starting';
    case transcoding = 'transcoding';
    case uploading = 'uploading';
    case available = 'available';
    case in_progress = 'in_progress';
}
