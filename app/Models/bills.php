<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Casts\AsCollection;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Support\Arr;

    class bills extends Model
    {
        use HasFactory;

        protected $appends = [ 'user_name', 'branch_name', 'trader_name', 'products_count' ];
        protected $casts = [
            'products' => AsCollection::class
        ];

        public function getProductsCountAttribute ()
        {
            return collect($this->products)->count();
        }

        public function getUserNameAttribute ()
        {
            $user = User::find( $this->user_id );
            $stuff = staffs::find( $this->user_id );
            return  $this->user_type === "Admin" ? $user->name ?? null : $stuff->name ?? null;
        }

        public function getBranchNameAttribute ()
        {
            $branch = branchs::find( $this->branchs_id );
            return $branch->name_ar ?? null;
        }

        public function getTraderNameAttribute ()
        {
            $trader = trader::find( $this->trader_id );
            return $trader ? $trader->name : 'نقدي';
        }


    }
