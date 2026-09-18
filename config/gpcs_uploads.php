<?php

return [
    'paper_max_mb' => (int) env('PAPER_MAX_MB', 100),
    'notes_max_mb' => (int) env('NOTES_MAX_MB', 200),
    'gallery_max_mb' => (int) env('GALLERY_MAX_MB', 20),

    // Optional hard ceiling for the Railway upload volume. Set this to the
    // provisioned volume size so capacity checks do not rely only on the host
    // filesystem's free-space report, which may be larger than the volume quota.
    // Use 0 to disable the explicit ceiling and rely on disk_free_space().
    'volume_capacity_mb' => (int) env('UPLOAD_VOLUME_CAPACITY_MB', 0),
];
