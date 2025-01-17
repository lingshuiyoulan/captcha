<?php
declare(strict_types=1);
use  \Fastknife\Service\BlockPuzzleCaptchaService;

class BlockPuzzleController
{
    public function get(){
        $config = require '../src/config.php';
        $service = new BlockPuzzleCaptchaService($config);
         $data = $service->get();
        echo json_encode([
            'error' => false,
            'repCode' => '0000',
            'repData' => $data,
            'repMsg' => null,
            'success' => true,
        ]);
    }

    public function check()
    {
        $config = require '../src/config.php';
        $service = new BlockPuzzleCaptchaService($config);
        $data = $_REQUEST;
        $msg = null;
        $error = false;
        $repCode = '0000';
        try {
            $service->check($data['token'], $data['pointJson']);
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            $error = true;
            $repCode = '6111';
        }
        echo json_encode([
            'error' => $error,
            'repCode' => $repCode,
            'repData' => null,
            'repMsg' => $msg,
            'success' => ! $error,
        ]);
    }
}
