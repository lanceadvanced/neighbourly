<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

trait Associated
{
    public function association($key): Collection|Model|self|null
    {
        if(isset($this->associations[$key])){
            $association = $this->associations[$key];
            if(isset($association['complex'])) {
                $results = new Collection();
                $linkingEntries = ($association['linking'][1])::where($association['linking'][0], $this->getKey())->get();
                foreach ($linkingEntries as $linkingEntry) {
                    $target = ($association['target'][1])::find($linkingEntry->{$association['target'][0]});
                    $result = [];
                    foreach ($association['keep']['linking']['attributes'] as $attribute) {
                        $result[$association['keep']['linking']['prefix'] . '.' . $attribute] = $linkingEntry->{$attribute};
                    }
                    foreach ($association['keep']['target']['attributes'] as $attribute) {
                        $result[$association['keep']['target']['prefix'] . '.' . $attribute] = $target->{$attribute};
                    }
                    $results->push($result);
                }
                return $results;
            } else if(isset($association['many']) || isset($association['one'])) {
                $type = isset($association['many']) ? 'many' : 'one';
                $association = $association[$type][0]::where($association[$type][1], $this->getKey())->get();
                return $type == 'many' ? $association : $association[0];
            } else {
                return $association[0]::find($this->{$association[1]});
            }

        }

        return null;
    }
}
