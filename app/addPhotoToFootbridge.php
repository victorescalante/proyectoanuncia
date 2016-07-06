<?php namespace Anuncia;


use Anuncia\Photo;
use Anuncia\Thumbnail;
use Illuminate\Http\UploadedFile;



Class addPhotoToFootbridge {

    protected $footbridge;
    protected $file;
    protected $thumbnail;

    public function __construct(Footbridge $footbridge, UploadedFile $file, Thumbnail $thumbnail = null)
    {
        //var_dump("entro al save2");
        $this->footbridge = $footbridge;
        $this->file = $file;
        $this->thumbnail = $thumbnail ?: new Thumbnail;
    }


    public function save()
    {
        
        /* Implement Try Error in the method  */

        $photo = $this->footbridge->addPhoto($this->makePhoto());

        //Move the photo to the image folder
        $this->file->move($photo->baseDir(), $photo->name);

        //generate a thumbnail
        $this->thumbnail->make($photo->path,$photo->thumbnail_path);
    }

    protected function makePhoto()
    {
        return new Photo([
            'name' =>  $this->makeFileName()
        ]);
    }


    protected function makeFileName()
    {
        $name = sha1(
            time().$this->file->getClientOriginalName()
        );

        $extension = $this->file->getClientOriginalExtension();

        return "{$name}.{$extension}";
    }


}


