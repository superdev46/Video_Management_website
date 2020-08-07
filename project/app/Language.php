<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $fillable = ['home','home1','home2','fht', 'about', 'faq', 'contact', 'signin', 'signup', 'bgs', 'rds','hcs', 'lns', 'lm', 'vd','ston', 's', 'fl','sm', 'fpw', 'cn', 'al','bg', 'dni', 'search', 'ec','sbg','dashboard','edit','reset','logout','cp','np','rnp','chnp','ss','bs','blog','sie','spe','suf','suph','sue','sup','sucp','fpt','fpe','fpb','con','cop','coe','cor','vdn','vt','gt','dopd','doo','dol','doa','doe','dor','dopr','doc','doci','dosp','don','doem','dom','fname','cup','pp','app','size','md','amf','doct','doad','doph','dofx','dofpl','dotpl','dogpl','dolpl','doeml','doupl','supl','success','dttl','ddesc','ppr'];

    public $timestamps = false;
}
