<?php

use HWafeq\LaravelWafeq\Data\FileData;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;

uses(FakesWafeq::class);

it('lists files', function () {
    $this->fakeWafeqPage('/files/', [
        ['id' => 'f_1', 'name' => 'receipt.pdf', 'mimeType' => 'application/pdf', 'size' => 12345, 'url' => 'https://files.wafeq.com/f_1.pdf'],
    ]);

    $page = LaravelWafeq::files()->list();

    expect($page->results[0])->toBeInstanceOf(FileData::class)
        ->and($page->results[0]->name)->toBe('receipt.pdf')
        ->and($page->results[0]->size)->toBe(12345);
});

it('retrieves a file', function () {
    $this->fakeWafeq('/files/f_1/', ['id' => 'f_1', 'name' => 'receipt.pdf', 'mimeType' => 'application/pdf', 'size' => 12345]);

    $file = LaravelWafeq::files()->retrieve('f_1');

    expect($file->id)->toBe('f_1');
});

it('destroys a file', function () {
    $this->fakeWafeq('/files/f_1/', '', 204);

    expect(LaravelWafeq::files()->destroy('f_1'))->toBeTrue();
});

it('uploads a file with multipart', function () {
    $this->fakeWafeq('/upload-file/', ['id' => 'f_new', 'name' => 'invoice.pdf', 'mimeType' => 'application/pdf', 'size' => 1024]);

    $file = LaravelWafeq::files()->upload([
        'name' => 'file',
        'contents' => 'BINARY_DATA',
        'filename' => 'invoice.pdf',
    ]);

    expect($file->id)->toBe('f_new')
        ->and($file->name)->toBe('invoice.pdf');
});

it('uploads a file raw', function () {
    $this->fakeWafeq('/upload-file-raw/', ['id' => 'f_raw', 'name' => 'raw.pdf', 'mimeType' => 'application/pdf', 'size' => 2048]);

    $file = LaravelWafeq::files()->uploadRaw([
        'name' => 'file',
        'contents' => 'BINARY_DATA',
        'filename' => 'raw.pdf',
    ]);

    expect($file->id)->toBe('f_raw');
});
