<?php

namespace SHOP\Shopping\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\Request;
use SHOP\CRM\Models\OrderProduct;
use Carbon\Carbon;
use Exception;

class AddOrderProduct implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $data;
    private $order;

    private $request_expire = 120; // seconds ~ 2 minutes
    private $cache_expire = 1800; // seconds ~ 30 minutes

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 1;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 300; // 5 minutes

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($order, $data)
    {
        $this->order = $order;
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if(!empty($this->order) && !empty($this->data)) {
            $products = json_decode($this->data['order_content'], true);
            foreach ($products as $item) {
                if ($item) {
                    $form_add = [
                        'name' => 'Order ' . $this->order['id'],
                        'status' => 1,
                        'order_id' => $this->order['id'],
                        'order_code' => $this->order['order_code'],
                        'user_id' => $this->data['user_id'],
                        'product_id' => $item['id'],
                        'product_name' => isset($item['name']) ? $item['name'] : null,
                        'category' => isset($item['category']) ? $item['category'] : null,
                        'brand' => isset($item['brand']) ? $item['brand'] : null,
                        'origin' => isset($item['origin']) ? $item['origin'] : null,
                        'quantity' => isset($item['quantity']) ? $item['quantity'] : 0,
                        'commission' => isset($item['commission']) ? $item['commission'] : 0,
                        'price' => isset($item['price']) ? $item['price'] : 0,
                        'cover_photo' => isset($item['cover_photo']) ? $item['cover_photo'] : null
                    ];
                    OrderProduct::create($form_add);
                }
            }
        }
    }

    /**
     * The job failed to process.
     *
     * @param  Exception  $exception
     * @return void
     */
    public function failed(Exception $exception)
    {
        var_dump($exception->getMessage());
    }
}
