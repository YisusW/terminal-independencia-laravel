<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TasaSalidaUser extends Model
{
    //

	protected $table = "tasa_salida_date";
    
    public function __construct(){

        setlocale(LC_ALL, "es_VE.UTF-8");    	
    }

	/**
	 * TasaSalidaUser belongs to User.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user()
	{
		// belongsTo(RelatedModel, foreignKey = user_id, keyOnRelatedModel = id)
		return $this->belongsTo(User::class , 'id_user' , 'id' );
	}

	/**
	 * TasaSalidaUser belongs to TasaSalida.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function tasaSalida()
	{
		// belongsTo(RelatedModel, foreignKey = tasaSalida_id, keyOnRelatedModel = id)
		return $this->belongsTo(TasaSalida::class , 'id_tasa_salida' , 'id' );
	}

	/**
	 * TasaSalidaUser has many TasaSalidaUser.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function TasaSalidaCount()
	{
		// hasMany(RelatedModel, foreignKeyOnRelatedModel = tasaSalidaUser_id, localKey = id)
		return $this->hasMany(TasaSalidaCount::class , 'id_tasa_salida_date' , 'id');
	}
}
