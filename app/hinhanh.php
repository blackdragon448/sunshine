<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class hinhanh extends Model
{
    public $timestamps=false;
    protected $table = 'hinhanh';
    protected $fillable=['ha_ten'];
    protected $guarded=['sp_ma', 'ha_stt'];
    protected $primaryKey =['sp_ma', 'ha_stt'];
    public $incrementing=false;
    protected function setKeysForSaveQuery(Builder $query)
    {
        $keys=$this->getKeyName();
        if(!is_array($keys)){
            return parent::setKeysForSaveQuery($query);
        }
        foreach($keys as $keyName){
            $query->where($keyName, '=', $this->getKeyForSaveQuery($keyName));
        }
        return $query;
    }
    protected function getKeyForSaveQuery($keyName=null)
    {
        if(is_null($keyName)){
            $keyName=$this->getKeyName();
        }
        if(isset($this->original[$keyName])){
            return $this->original[$keyName];
        }
        return $this->getAttribute($keyName);
    }
}
