<?php

	$file = $_FILES['file'];//�õ����������
	//�õ��ļ�����
	$name = $file['name'];
	$type = strtolower(substr($name,strrpos($name,'.')+1)); 	
	//�õ��ļ����ͣ����Ҷ�ת����Сд
   	$allow_type = array('jpg','jpeg','gif','png'); //���������ϴ������� 
	//�ж��ļ������Ƿ������ϴ�
    if(!in_array($type, $allow_type)){
	//�������������ֱ��ֹͣ��������
		return ;
	}
	//�ж��Ƿ���ͨ��HTTP POST�ϴ���
	if(!is_uploaded_file($file['tmp_name'])){
	//�������ͨ��HTTP POST�ϴ���
		return ;
	}
	$upload_path = "./"; //�ϴ��ļ��Ĵ��·��
	//��ʼ�ƶ��ļ�����Ӧ���ļ���
	if(move_uploaded_file($file['tmp_name'],$upload_path.$file['name'])){
		echo "Successfully!";
	}else{
		echo "Failed!";
	} 

?>