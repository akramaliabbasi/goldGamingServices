<?php

namespace app\modules\product\controllers;

use Yii;
use yii\web\Controller;
use app\modules\product\models\ProductSearch;
use app\modules\product\models\Product;
use yii\web\NotFoundHttpException;


/**
 * Default controller for the `product` module
 */
class ProductController  extends Controller
{
	
	 public $modelClass = 'app\modules\product\models\Product';
	 
  

	public function actions()
    {
        $actions = parent::actions();

        // disable the "delete" and "create" actions
     //   unset($actions['delete'], $actions['create']);

        return $actions;
    }
	
	
	public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
		]);
    }
	
	
	public function actionView($id)
    {
		
		$model =	$this->findModel($id);
		return $this->render('view', [
			'model' => $model,
		]);
    }
	
	public function actionCreate()
	{
		$model = new Product();
		if ($model->load(Yii::$app->request->post()) && $model->validate()) { 
			$model->save();
			return $this->redirect(['view', 'id' => $model->id]);
		} else { 
			return $this->render('create', [
				'model' => $model,
			]);
		}
	}


	
	public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->load(Yii::$app->request->post(), '');
       if ($model->load(Yii::$app->request->post()) && $model->validate()) { 
			$model->save();
			return $this->redirect(['view', 'id' => $model->id]);
		} else { 
			return $this->render('update', [
				'model' => $model,
			]);
		}
		
    }
	
	
	public function actionDelete($id)
    {
        $model = $this->findModel($id);
       if ($model->validate()) { 
			$model->delete();
			return $this->redirect(['index', 'id' => $model->id]);
		} else { 
			return $this->render('index', [
				'model' => $model,
			]);
		}
		
    }
	
	protected function findModel($id)
	{
		$model = Product::findOne($id);
		if ($model !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
	
	
	


}
