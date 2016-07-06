<?php namespace Anuncia;


use Anuncia\Thumbnail;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;


Class updatePhotoToFootbridge {

    protected $photo_previus;
    protected $file;
    protected $thumbnail;

    public function __construct(Photo $photo_previus, UploadedFile $file, Thumbnail $thumbnail = null)
    {
        $this->photo_previus = $photo_previus;
        $this->file = $file;
        $this->thumbnail = $thumbnail ?: new Thumbnail;
    }


    public function save()
    {

        /* Delete image previous */
        Storage::delete($this->photo_previus->name);
        Storage::delete('tn-'.$this->photo_previus->name);

        //Move the new photo to the image folder
        $this->file->move('images/footbridges', $this->makeFileName());

        //Save in the bd
        $this->photo_previus->name = $this->makeFileName();
        $this->photo_previus->path = 'images/footbridges/'.$this->makeFileName();
        $this->photo_previus->thumbnail_path = 'images/footbridges/tn-'.$this->makeFileName();
        $this->photo_previus->save();

        //generate a thumbnail
        $this->thumbnail->make($this->photo_previus->path,$this->photo_previus->thumbnail_path);
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


