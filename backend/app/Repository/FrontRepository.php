<?php
/**
 * 
 */
class FrontRepository 
{
	
	public function getAll($table)
	{
		return $table::all();
	}

	public function getAllByWhere($table, $where)
	{
		return $table::where($where)->get();
	}
	
	public function getById($id, $table)
	{
		return $table::where('id', $id)->first();
	}

	public function getByWhere($table, $where)
	{
		return $table::where($where)->first();
	}

	public function getAllByLimit($limit = 10)
	{
		return $this->model->select()
						   ->orderBy('created_at', 'desc')
						   ->paginate($limit);
	}

	public function getAllNoLimit()
	{
		return $this->model->select()
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

	public function delete($table, $where)
	{
		return $table::where($where)->delete();
	}


	public function create(array $attr, $table)
	{
		$data = $table::create($attr);

		return $data;
	}
}