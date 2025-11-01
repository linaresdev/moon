<?php
namespace Moon\Model;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model {

    protected $table = 'comments';

    protected $fillable = [
        "id",
        "commentable_type",
        "commentable_id",
        "author_id",
        "parent",
        "type",
        "body",
        "state",
        "created_at",
        "updated_at"
    ];

    public function date($format=null) {
        $date = $this->created_at;
        
        if( $format == null ) {
            return $date;
        }
    }

    public function deleteParents() {

        if( ($comment = (new self)->find($this->id)) ?? false )
        {
            if( $comment->hasParent() )
            {
                foreach( $comment->getParents() as $row ) 
                {
                    if( $row->hasParent() ) 
                    {
                        if( $row->hasParent() ) {
                            foreach( $row->getParents() as $row2 ) 
                            {
                                if( $row2->hasParent() ) {
                                    $IDS = $row2->makeParentID();
                                }
                                else {
                                    $row2->delete();
                                }
                            }
                        }
                        
                        $row->delete();
                    }
                    else {
                        $row->delete(); 
                    }
                }
            }

            $comment->delete();
        }
    }

    public function dateHuman() {
        return $this->created_at->diffForHumans();
    }
    
    public function answers($ID) {
        return (new self)->where("parent", $ID)->get();
    }

    public function order() {
        return $this->hasOne(\Moon\Model\Order::class, "id", "commentable_id");
    }
    public function author() {
        return $this->hasOne(\Moon\Model\User::class, "id", "author_id");
    }

    public function hasParent() {
        return ( $this->where("parent", $this->id)->count() > 0);
    }

    public function getParents() {
        return $this->where("parent", $this->id)->get();
    }
}