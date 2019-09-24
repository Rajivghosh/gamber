<?php

namespace App\Repository;
use Auth;
use App\Models\PageContent;
use App\Models\Category;

/**
 * 
 */
class AdminRepository 
{

	public function getAll($table)
	{
		return $table::all();
	}

	public function getAllLimit($table, $limit)
	{
		return $table->select()
					 ->orderBy('title', 'asc')
					 ->paginate($limit);
	}

	public function getAllLimitCom($table, $where, $limit)
	{
		return $table->select()
					 ->where($where)
					 ->orderBy('company_name', 'asc')
					 ->paginate($limit);
	}


	public function getAllLimitCompany($table)
	{
		return $table->select()
					 ->orderBy('company_name', 'asc')
					 ->get();
	}


	public function findCreate($table, array $where)
	{
		return $table::firstOrCreate($where);
	}

	public function getAllByWhere($table, array $where)
	{
		return $table::where($where)->get();
	}

	public function getAllByWherePaginate($table, $where, $limit)
	{
		return $table::where($where)->paginate($limit);
	}


	
	public function getById($id, $table)
	{
		return $table::where('id', $id)->first();
	}

	public function getByWhere($table, $where)
	{
		return $table::where($where)->first();
	}

	public function getByWhere1($table, array $where)
	{
		return $table::where($where)->first();
	}

	public function getAllByLimitInPaginate($limit, $table, array $where)
	{
		return $table->select()
					 ->where($where)
				     ->orderBy('created_at', 'asc')
					 ->paginate($limit);
	}


	public function getAllByLimitInPaginate2($limit, $table, array $where)
	{
		return $table->select()
					 ->where($where)
				     ->orderBy('company_name', 'desc')
					 ->paginate($limit);
	}

	public function getAllByLimitInPaginate1($limit, $table, array $where)
	{
		return $table->select()
					 ->where($where)
				     ->orderBy('bid_price', 'desc')
					 ->paginate($limit);
	}

	public function getAllPaginate($limit, $table)
	{
		return $table->select()
					 ->orderBy('created_at', 'desc')
					 ->paginate($limit);
	}


	public function getAllByLimitInPaginateASC($limit, $table, array $where)
	{
		return $table->select()
					 ->where($where)
				     ->orderBy('created_at', 'asc')
					 ->paginate($limit);
	}


	public function getAllByLimitInPaginateLP($limit, $table, $order, array $where)
	{
		return $table->select()
					 ->where($where)
				     ->orderBy('prop_price', $order)
					 ->paginate($limit);
	}


	public function getAllByLimitInPaginateLPWish($limit, $table, $order, array $where)
	{
		// return $table->select()
		// 			 ->where($where)
		// 		     ->orderBy('prop_price', $order)
		// 			 ->paginate($limit);

		if(Auth::user())
		{
			$user_id = Auth::user()->id;
			return $table->with(['wishlist'=>function($q) use ($user_id){
			$q->where('user_id', $user_id );
		}])->select()
						   ->where($where)
						   ->orderBy('prop_price', $order)
						   ->paginate($limit);
		} 
		else 
		{
			return $table->with('wishlist')->where($where)
						   ->orderBy('prop_price', $order)
						   ->limit($limit)
						   ->paginate($limit);
		}
	}


	public function getAllByLimitInPaginateHP($limit, $table, array $where)
	{
		return $table->select()
					 ->where($where)
				     ->orderBy('prop_price', 'desc')
					 ->paginate($limit);
	}


	public function getAllByLimit($limit, array $where, $table)
	{
		return $table->select()
						   ->where($where)
						   ->orderBy('created_at', 'desc')
						   ->limit($limit)
						   ->get();
	}


	public function getAllByLimitWish($limit, array $where, $table)
	{
		if(Auth::user())
		{
			$user_id = Auth::user()->id;
			return $table->with(['wishlist'=>function($q) use ($user_id){
			$q->where('user_id', $user_id );
		}])->select()
						   ->where($where)
						   ->orderBy('created_at', 'desc')
						   ->limit($limit)
						   ->get();
		} 
		else 
		{
			return $table->with('wishlist')->where($where)
						   ->orderBy('created_at', 'desc')
						   ->limit($limit)
						   ->get();
		}
		
	}


	public function getAllByLimitWish1($limit, array $where, $table)
	{
		if(Auth::user())
		{
			$user_id = Auth::user()->id;
			return $table->with(['wishlist'=>function($q) use ($user_id){
			$q->where('user_id', $user_id );
		}])->select()
						   ->where($where)
						   ->orderBy('created_at', 'desc')
						   ->paginate($limit);
		} 
		else 
		{
			return $table->with('wishlist')->where($where)
						   ->orderBy('created_at', 'desc')
						   ->limit($limit)
						   ->paginate($limit);;
		}
		
	}


	public function getAllByLimitWithoutWhere($limit, $table, $where)
	{
		return $table->select()
						   ->where($where)
						   ->orderBy('created_at', 'desc')
						   ->limit($limit)
						   ->get();
	}

	public function getAllNoLimit($table, $where)
	{
		return $table->select()
					 ->where($where)
					 ->orderBy('created_at', 'desc')
					 ->get();
	}

	public function update(array $attr, $id, $getDataBack = false, $table)
	{
		$update = $table::where('id', $id)->update($attr);
		
		if($getDataBack)
		{
			$update = $this->getById($id);
		}

		return $update;
	}


	public function update1(array $attr, $getDataBack = false, $table, $where)
	{
		$update = $table::where($where)->update($attr);
		
		if($getDataBack)
		{
			$update = $this->getById($id);
		}

		return $update;
	}

	public function delete($table, $where)
	{
		return $table::where($where)->delete();
	}


	public function create(array $attr, $table)
	{
		$data = $table::create($attr);

		return $data;
	}

	public function getAllByFilter($table, $where, $wherein, $limit)
	{
		return $table::where($where)->whereIn('catid',$wherein)->paginate($limit);
	}

	public function getAllByFilter1($table, $where, $wherein, $limit)
	{
		// return $table::where($where)->whereIn('catid',$wherein)->paginate($limit);

		if(Auth::user())
		{
			$user_id = Auth::user()->id;
			return $table->with(['wishlist'=>function($q) use ($user_id){
				$q->where('user_id', $user_id );
				}])->select()->where($where)->whereIn('catid',$wherein)->orderBy('created_at', 'desc')->paginate($limit);
		} 
		else 
		{
			return $table->with('wishlist')
						 ->where($where)
						 ->whereIn('catid',$wherein)
						 ->orderBy('created_at', 'desc')
						 ->paginate($limit);;
		}
	}

	public function getPageContent($slug)
	{
		return PageContent::where('slug', $slug)->first();
	}

	public function dynamicCategory()
	{
		return Category::where('parent_type', 0)->get();

	}
}