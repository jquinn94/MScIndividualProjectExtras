from imageai.Prediction.Custom import ModelTraining

model_trainer = ModelTraining()
model_trainer.setModelTypeAsResNet()
model_trainer.setDataDirectory("banana")
model_trainer.trainModel(num_objects=5, num_experiments=200, enhance_data=True, batch_size=128)
